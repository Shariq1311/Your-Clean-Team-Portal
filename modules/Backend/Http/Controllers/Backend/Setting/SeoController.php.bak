<?php

namespace MojarCMS\Backend\Http\Controllers\Backend\Setting;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use MojarCMS\CMS\Http\Controllers\BackendController;

class SeoController extends BackendController
{
    public function getStringRaw(Request $request): \Illuminate\Http\JsonResponse
    {
        $title = $request->input('title', '');
        $description = $request->input('description', '');
        $content = $request->input('content', $description);
        $slug = $request->input('slug', '');
        
        $enableAiSeo = get_config('enable_ai_seo');
        $geminiApiKey = get_config('gemini_api_key');

        if (empty($slug)) {
            $slug = $title;
        }

        // Check if AI SEO is enabled and API key is available
        if ($enableAiSeo && !empty($geminiApiKey)) {
            try {
                $optimizedTitle = $this->generateAiTitle($title, $content, $geminiApiKey);
                $optimizedDescription = $this->generateAiDescription($description, $title, $content, $geminiApiKey);
                
                return response()->json([
                    'status' => true,
                    'title' => seo_string($optimizedTitle, 70),
                    'description' => seo_string($optimizedDescription, 300),
                    'slug' => Str::slug(seo_string($slug, 70)),
                    'ai_generated' => true
                ]);
            } catch (\Exception $e) {
                Log::error('AI SEO Generation Failed: ' . $e->getMessage());
                // Fall back to traditional method on error
            }
        }

        // Traditional SEO generation (fallback)
        $optimizedTitle = $this->generateTitle($title, $slug);
        $optimizedDescription = $this->generateDescription($description, $content, $slug);

        return response()->json([
            'status' => true,
            'title' => seo_string($optimizedTitle, 70),
            'description' => seo_string($optimizedDescription, 300),
            'slug' => Str::slug(seo_string($slug, 70)),
            'ai_generated' => false
        ]);
    }

    /**
     * Generate AI-optimized title using Gemini
     */
    private function generateAiTitle(string $title, string $content, string $apiKey): string
    {
        if (empty($title)) {
            return '';
        }

        // Cache key for title generation
        $cacheKey = 'ai_seo_title_' . md5($title . substr($content, 0, 200));
        
        return Cache::remember($cacheKey, 3600, function () use ($title, $content, $apiKey) {
            $prompt = $this->buildTitlePrompt($title, $content);
            $aiResponse = $this->callGeminiApi($prompt, $apiKey);
            
            if ($aiResponse && strlen($aiResponse) > 0) {
                return trim($aiResponse);
            }
            
            return $title; // Return original if AI fails
        });
    }

    /**
     * Generate AI-optimized description using Gemini
     */
    private function generateAiDescription(string $description, string $title, string $content, string $apiKey): string
    {
        // Cache key for description generation
        $cacheKey = 'ai_seo_desc_' . md5($description . $title . substr($content, 0, 300));
        
        return Cache::remember($cacheKey, 3600, function () use ($description, $title, $content, $apiKey) {
            $prompt = $this->buildDescriptionPrompt($description, $title, $content);
            $aiResponse = $this->callGeminiApi($prompt, $apiKey);
            
            if ($aiResponse && strlen($aiResponse) > 0) {
                return trim($aiResponse);
            }
            
            // Fallback to traditional description generation
            return $this->generateDescription($description, $content, '');
        });
    }

    /**
     * Call Gemini API
     */
    private function callGeminiApi(string $prompt, string $apiKey): ?string
    {
        try {
            $response = Http::timeout(30)
                ->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key={$apiKey}", [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $prompt]
                            ]
                        ]
                    ],
                    'generationConfig' => [
                        'temperature' => 0.7,
                        'maxOutputTokens' => 200,
                        'topP' => 0.8,
                    ]
                ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['candidates'][0]['content']['parts'][0]['text'] ?? null;
            }
            
            Log::error('Gemini API Error: HTTP ' . $response->status());
            return null;
        } catch (\Exception $e) {
            Log::error('Gemini API Exception: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Build title generation prompt
     */
    private function buildTitlePrompt(string $title, string $content): string
    {
        $contentPreview = substr(strip_tags($content), 0, 300);
        
        return "Create an SEO-optimized title (maximum 60 characters) that is compelling and keyword-rich. " .
               "Make it click-worthy and search engine friendly. " .
               "Original title: '{$title}' " .
               "Content context: {$contentPreview}... " .
               "Return ONLY the optimized title, no explanations or quotes.";
    }

    /**
     * Build description generation prompt
     */
    private function buildDescriptionPrompt(string $description, string $title, string $content): string
    {
        $contentPreview = substr(strip_tags($content), 0, 400);
        
        return "Create an SEO-optimized meta description (maximum 160 characters) that summarizes the content effectively. " .
               "Make it compelling and include relevant keywords. " .
               "Title: '{$title}' " .
               "Current description: '{$description}' " .
               "Content context: {$contentPreview}... " .
               "Return ONLY the optimized meta description, no explanations or quotes.";
    }

    /**
     * Traditional title generation (fallback method)
     */
    private function generateTitle($title, $slug): string
    {
        if (empty($title)) {
            return ucwords(str_replace(['-', '_'], ' ', $slug));
        }

        // Basic SEO improvements
        $title = trim($title);
        $title = preg_replace('/[^\w\s\-]/', '', $title);
        $title = ucwords(strtolower($title));
        
        return $title;
    }

    /**
     * Traditional description generation (fallback method)
     */
    private function generateDescription($description, $content, $slug): string
    {
        if (!empty($description)) {
            return trim($description);
        }

        // Generate from content if no description
        if (!empty($content)) {
            $text = strip_tags($content);
            $sentences = explode('.', $text);
            
            $result = '';
            foreach ($sentences as $sentence) {
                $sentence = trim($sentence);
                if (strlen($sentence) > 10 && strlen($result . $sentence) < 280) {
                    $result .= $sentence . '. ';
                } else {
                    break;
                }
            }
            
            if (!empty($result)) {
                return trim($result);
            }
        }

        // Final fallback
        return !empty($slug) ? 'Learn more about ' . str_replace(['-', '_'], ' ', $slug) : '';
    }
}