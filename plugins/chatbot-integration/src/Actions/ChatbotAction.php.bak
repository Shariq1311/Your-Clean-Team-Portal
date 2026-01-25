<?php

declare(strict_types=1);

namespace Mojahid\ChatbotIntegration\Actions;

use Illuminate\Http\Request;
use MojarCMS\CMS\Abstracts\Action;
use MojarCMS\CMS\Facades\HookAction;

final class ChatbotAction extends Action
{
    public function handle(): void
    {
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'registerFrontendActions']);
    }

    public function registerFrontendActions(): void
    {
        // Add chatbot scripts to frontend
        HookAction::addAction('theme.header', [$this, 'addChatbotScripts'], 20);
    }

    public function addChatbotScripts(): void
    {
        if (!get_config('chatbot_enabled', true)) {
            return;
        }

        $providers = get_config('chatbot_providers', []);
        $scripts = '';

        foreach ($providers as $providerKey => $config) {
            // Check both 'enable' and 'enabled' keys for compatibility
            $isEnabled = !empty($config['enabled']) && $config['enabled'] !== '0';
            if (!$isEnabled) {
                continue;
            }

            try {
                $providerScript = $this->renderProviderScript($providerKey, $config);
                if (!empty($providerScript)) {
                    $scripts .= $providerScript;
                }
            } catch (\Exception $e) {
                // Log error but continue with other providers
                error_log("Chatbot provider {$providerKey} failed: " . $e->getMessage());
            }
        }

        echo $scripts;
    }

    private function renderProviderScript(string $provider, array $config): string
    {
        switch ($provider) {
            case 'crisp':
                return $this->renderCrispScript($config);
            case 'tidio':
                return $this->renderTidioScript($config);
            case 'whatsapp':
                return $this->renderWhatsAppScript($config);
            case 'messenger':
                return $this->renderMessengerScript($config);
            case 'livechat':
                return $this->renderLiveChatScript($config);
            case 'zendesk':
                return $this->renderZendeskScript($config);
            case 'tawkto':
                return $this->renderTawkToScript($config);
            default:
                return '';
        }
    }

    private function renderCrispScript(array $config): string
    {
        if (empty($config['website_id'])) {
            return '';
        }

        $websiteId = $this->sanitize($config['website_id']);
        $locale = $this->sanitize($config['locale'] ?? 'en');
        $themeColor = $this->sanitize($config['color'] ?? $config['theme_color'] ?? '#0084FF');
        $autoShowDelay = (int) ($config['auto_show_delay'] ?? 0);
        
        $script = "<script type=\"text/javascript\">\n";
        $script .= "window.\$crisp=[];window.CRISP_WEBSITE_ID=\"{$websiteId}\";\n";
        
        // Set locale if not auto
        if ($locale !== 'auto') {
            $script .= "window.\$crisp.push(['set', 'session:data', [['locale', '{$locale}']]]);\n";
        }
        
        // Set theme color
        $script .= "window.\$crisp.push(['config', 'color:theme', '{$themeColor}']);\n";
        
        // Set position
        if (!empty($config['position']) && $config['position'] === 'left') {
            $script .= "window.\$crisp.push(['config', 'position:reverse', true]);\n";
        }
        
        // Hide when offline
        if (!empty($config['hide_when_offline'])) {
            $script .= "window.\$crisp.push(['config', 'hide:on:away', true]);\n";
            $script .= "window.\$crisp.push(['config', 'hide:on:mobile', true]);\n";
        }
        
        // Auto show delay
        if ($autoShowDelay > 0) {
            $script .= "setTimeout(function() {\n";
            $script .= "  window.\$crisp.push(['do', 'chat:show']);\n";
            $script .= "}, {$autoShowDelay} * 1000);\n";
        }
        
        $script .= "(function(){d=document;s=d.createElement('script');\n";
        $script .= "s.src='https://client.crisp.chat/l.js';s.async=1;\n";
        $script .= "d.getElementsByTagName('head')[0].appendChild(s);})();\n";
        $script .= "</script>\n";
        
        return $script;
    }

    private function renderTidioScript(array $config): string
    {
        if (empty($config['public_key'])) {
            return '';
        }

        $publicKey = $this->sanitize($config['public_key']);
        $themeColor = $this->sanitize($config['primary_color'] ?? $config['theme_color'] ?? '#3675F4');
        $autoShowDelay = (int) ($config['auto_show_delay'] ?? 0);
        
        $script = "<script type=\"text/javascript\">\n";
        
        // Tidio configuration
        $script .= "window.tidioChatOptions = {\n";
        $script .= "  color: '{$themeColor}',\n";
        
        if (!empty($config['position']) && $config['position'] === 'left') {
            $script .= "  position: 'bottom-left',\n";
        } else {
            $script .= "  position: 'bottom-right',\n";
        }
        
        if (!empty($config['hide_when_offline'])) {
            $script .= "  hideWhenOffline: true,\n";
        }
        
        $script .= "};\n";
        
        // Auto show delay
        if ($autoShowDelay > 0) {
            $script .= "setTimeout(function() {\n";
            $script .= "  if (window.tidioChatApi) {\n";
            $script .= "    window.tidioChatApi.open();\n";
            $script .= "  }\n";
            $script .= "}, {$autoShowDelay} * 1000);\n";
        }
        
        $script .= "</script>\n";
        $script .= "<script src=\"//code.tidio.co/{$publicKey}.js\" async></script>\n";
        
        return $script;
    }

    private function renderWhatsAppScript(array $config): string
    {
        if (empty($config['phone_number'])) {
            return '';
        }

        $phoneNumber = $this->sanitize($config['phone_number']);
        $message = $this->sanitize($config['default_message'] ?? 'Hello! How can I help you?');
        $buttonText = $this->sanitize($config['button_text'] ?? 'Chat on WhatsApp');
        $themeColor = $this->sanitize($config['theme_color'] ?? '#25D366');
        $position = $config['position'] ?? 'bottom-right';
        $autoShowDelay = (int) ($config['auto_show_delay'] ?? 0);
        
        // Determine position CSS
        $positionCss = $this->getPositionCss($position);
        
        $script = "<style>\n";
        $script .= "#whatsapp-widget {\n";
        $script .= "  position: fixed;\n";
        $script .= "  {$positionCss}\n";
        $script .= "  z-index: 9999;\n";
        $script .= "  transition: all 0.3s ease;\n";
        if ($autoShowDelay > 0) {
            $script .= "  opacity: 0;\n";
            $script .= "  transform: scale(0);\n";
        }
        $script .= "}\n";
        $script .= "#whatsapp-widget a {\n";
        $script .= "  background: {$themeColor};\n";
        $script .= "  color: white;\n";
        $script .= "  padding: 12px 20px;\n";
        $script .= "  border-radius: 50px;\n";
        $script .= "  text-decoration: none;\n";
        $script .= "  box-shadow: 0 4px 15px rgba(0,0,0,0.2);\n";
        $script .= "  display: flex;\n";
        $script .= "  align-items: center;\n";
        $script .= "  gap: 8px;\n";
        $script .= "  font-family: Arial, sans-serif;\n";
        $script .= "  font-size: 14px;\n";
        $script .= "  font-weight: 500;\n";
        $script .= "}\n";
        $script .= "#whatsapp-widget a:hover {\n";
        $script .= "  transform: translateY(-2px);\n";
        $script .= "  box-shadow: 0 6px 20px rgba(0,0,0,0.3);\n";
        $script .= "}\n";
        $script .= "</style>\n";
        
        $script .= "<div id='whatsapp-widget'>\n";
        $script .= "  <a href='https://wa.me/{$phoneNumber}?text=" . urlencode($message) . "' target='_blank'>\n";
        $script .= "    <svg width='20' height='20' viewBox='0 0 24 24' fill='currentColor'>\n";
        $script .= "      <path d='M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488'/>\n";
        $script .= "    </svg>\n";
        $script .= "    {$buttonText}\n";
        $script .= "  </a>\n";
        $script .= "</div>\n";
        
        // Auto show script
        if ($autoShowDelay > 0) {
            $script .= "<script>\n";
            $script .= "setTimeout(function() {\n";
            $script .= "  const widget = document.getElementById('whatsapp-widget');\n";
            $script .= "  if (widget) {\n";
            $script .= "    widget.style.opacity = '1';\n";
            $script .= "    widget.style.transform = 'scale(1)';\n";
            $script .= "  }\n";
            $script .= "}, {$autoShowDelay} * 1000);\n";
            $script .= "</script>\n";
        }
        
        return $script;
    }

    private function renderMessengerScript(array $config): string
    {
        // Facebook Messenger Chat Plugin was discontinued on May 9, 2024
        // We'll redirect to m.me link instead as suggested by Meta
        if (empty($config['page_id'])) {
            return '';
        }

        $pageId = $this->sanitize($config['page_id']);
        $themeColor = $this->sanitize($config['theme_color'] ?? '#0084FF');
        $buttonText = $this->sanitize($config['button_text'] ?? 'Message us on Messenger');
        $position = $config['position'] ?? 'bottom-right';
        $autoShowDelay = (int) ($config['auto_show_delay'] ?? 0);
        
        // Determine position CSS
        $positionCss = $this->getPositionCss($position);
        
        // Create a custom Messenger button that redirects to m.me
        $script = "<style>\n";
        $script .= "#messenger-widget {\n";
        $script .= "  position: fixed;\n";
        $script .= "  {$positionCss}\n";
        $script .= "  z-index: 9999;\n";
        $script .= "  transition: all 0.3s ease;\n";
        if ($autoShowDelay > 0) {
            $script .= "  opacity: 0;\n";
            $script .= "  transform: scale(0);\n";
        }
        $script .= "}\n";
        $script .= "#messenger-widget a {\n";
        $script .= "  background: {$themeColor};\n";
        $script .= "  color: white;\n";
        $script .= "  padding: 12px 20px;\n";
        $script .= "  border-radius: 50px;\n";
        $script .= "  text-decoration: none;\n";
        $script .= "  box-shadow: 0 4px 15px rgba(0,0,0,0.2);\n";
        $script .= "  display: flex;\n";
        $script .= "  align-items: center;\n";
        $script .= "  gap: 8px;\n";
        $script .= "  font-family: Arial, sans-serif;\n";
        $script .= "  font-size: 14px;\n";
        $script .= "  font-weight: 500;\n";
        $script .= "}\n";
        $script .= "#messenger-widget a:hover {\n";
        $script .= "  transform: translateY(-2px);\n";
        $script .= "  box-shadow: 0 6px 20px rgba(0,0,0,0.3);\n";
        $script .= "}\n";
        $script .= "</style>\n";
        
        $script .= "<div id='messenger-widget'>\n";
        $script .= "  <a href='https://m.me/{$pageId}' target='_blank'>\n";
        $script .= "    <svg width='20' height='20' viewBox='0 0 24 24' fill='currentColor'>\n";
        $script .= "      <path d='M12 0C5.373 0 0 4.975 0 11.111c0 3.497 1.745 6.616 4.472 8.652V24l4.086-2.242c1.09.301 2.246.464 3.442.464 6.627 0 12-4.974 12-11.111C24 4.975 18.627 0 12 0zm1.191 14.963l-3.055-3.26-5.963 3.26L10.732 8.1l3.13 3.26L19.745 8.1l-6.554 6.863z'/>\n";
        $script .= "    </svg>\n";
        $script .= "    {$buttonText}\n";
        $script .= "  </a>\n";
        $script .= "</div>\n";
        
        // Auto show script
        if ($autoShowDelay > 0) {
            $script .= "<script>\n";
            $script .= "setTimeout(function() {\n";
            $script .= "  const widget = document.getElementById('messenger-widget');\n";
            $script .= "  if (widget) {\n";
            $script .= "    widget.style.opacity = '1';\n";
            $script .= "    widget.style.transform = 'scale(1)';\n";
            $script .= "  }\n";
            $script .= "}, {$autoShowDelay} * 1000);\n";
            $script .= "</script>\n";
        }
        
        return $script;
    }

    private function renderLiveChatScript(array $config): string
    {
        if (empty($config['license_id'])) {
            return '';
        }

        $licenseId = $this->sanitize($config['license_id']);
        $groupId = !empty($config['group_id']) ? $this->sanitize($config['group_id']) : '';
        $themeColor = $this->sanitize($config['theme_color'] ?? '#0078D4');
        $autoShowDelay = (int) ($config['auto_show_delay'] ?? 0);
        
        $script = "<script type=\"text/javascript\">\n";
        $script .= "window.__lc = window.__lc || {};\n";
        $script .= "window.__lc.license = {$licenseId};\n";
        
        if ($groupId) {
            $script .= "window.__lc.group = {$groupId};\n";
        }
        
        // Configuration
        $script .= "window.__lc.params = [\n";
        $script .= "  {name: 'color', value: '{$themeColor}'},\n";
        
        if (!empty($config['position']) && $config['position'] === 'left') { 
            $script .= "  {name: 'position', value: 'left'},\n";
        }
        
        if (!empty($config['hide_when_offline'])) {
            $script .= "  {name: 'hide_offline', value: 'true'},\n";
        }
        
        $script .= "];\n";
        
        // Auto show delay
        if ($autoShowDelay > 0) {
            $script .= "window.__lc.visitor = {\n";
            $script .= "  name: '',\n";
            $script .= "  email: ''\n";
            $script .= "};\n";
            $script .= "setTimeout(function() {\n";
            $script .= "  if (window.LC_API) {\n";
            $script .= "    window.LC_API.open_chat_window();\n";
            $script .= "  }\n";
            $script .= "}, {$autoShowDelay} * 1000);\n";
        }
        
        $script .= "(function() {\n";
        $script .= "  var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;\n";
        $script .= "  lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';\n";
        $script .= "  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);\n";
        $script .= "})();\n";
        $script .= "</script>\n";
        
        return $script;
    }

    private function renderZendeskScript(array $config): string
    {
        if (empty($config['widget_key'])) {
            return '';
        }

        $widgetKey = $this->sanitize($config['widget_key']);
        $themeColor = $this->sanitize($config['theme_color'] ?? '#03363D');
        $autoShowDelay = (int) ($config['auto_show_delay'] ?? 0);
        $position = $config['position'] ?? 'bottom-right';
        
        // Updated Zendesk implementation with proper error handling
        $script = "<script id=\"ze-snippet\" src=\"https://static.zdassets.com/ekr/snippet.js?key={$widgetKey}\" async defer></script>\n";
        $script .= "<script type=\"text/javascript\">\n";
        $script .= "  window.zESettings = {\n";
        $script .= "    webWidget: {\n";
        $script .= "      color: {\n";
        $script .= "        theme: '{$themeColor}'\n";
        $script .= "      },\n";
        
        // Position settings
        $positionMap = [
            'bottom-right' => ['horizontal' => 'right', 'vertical' => 'bottom'],
            'bottom-left' => ['horizontal' => 'left', 'vertical' => 'bottom'],
            'top-right' => ['horizontal' => 'right', 'vertical' => 'top'],
            'top-left' => ['horizontal' => 'left', 'vertical' => 'top']
        ];
        
        $horizontal = strpos($position, 'left') !== false ? 'left' : 'right';
        $vertical = strpos($position, 'top') !== false ? 'top' : 'bottom';
        
        $script .= "      position: {\n";
        $script .= "        horizontal: '{$horizontal}',\n";
        $script .= "        vertical: '{$vertical}'\n";
        $script .= "      }\n";
        $script .= "    }\n";
        $script .= "  };\n";
        
        // Auto show with proper API detection
        if ($autoShowDelay > 0) {
            $script .= "  function openZendeskWidget() {\n";
            $script .= "    if (typeof zE !== 'undefined') {\n";
            $script .= "      try {\n";
            $script .= "        // Try new messaging API first\n";
            $script .= "        if (zE.messenger && zE.messenger.open) {\n";
            $script .= "          zE.messenger.open();\n";
            $script .= "        } else if (zE.webWidget && zE.webWidget.open) {\n";
            $script .= "          zE.webWidget.open();\n";
            $script .= "        } else {\n";
            $script .= "          // Fallback for older API\n";
            $script .= "          zE('webWidget', 'open');\n";
            $script .= "        }\n";
            $script .= "      } catch(e) {\n";
            $script .= "        console.log('Zendesk widget open failed:', e);\n";
            $script .= "      }\n";
            $script .= "    }\n";
            $script .= "  }\n";
            $script .= "  setTimeout(openZendeskWidget, {$autoShowDelay} * 1000);\n";
        }
        
        $script .= "</script>\n";
        
        return $script;
    }

    private function renderTawkToScript(array $config): string
    {
        if (empty($config['property_id']) || empty($config['widget_id'])) {
            return '';
        }

        $propertyId = $this->sanitize($config['property_id']);
        $widgetId = $this->sanitize($config['widget_id']);
        $themeColor = $this->sanitize($config['theme_color'] ?? '#00A78F');
        $autoShowDelay = (int) ($config['auto_show_delay'] ?? 0);
        $position = $config['position'] ?? 'br';
        
        $script = "<script type=\"text/javascript\">\n";
        $script .= "var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();\n";
        
        // Configuration
        $script .= "Tawk_API.customStyle = {\n";
        $script .= "  color: '{$themeColor}'\n";
        $script .= "};\n";
        
        if (!empty($config['hide_when_offline'])) {
            $script .= "Tawk_API.hideOfflineButton = true;\n";
        }
        
        if (!empty($config['invisible_mode'])) {
            $script .= "Tawk_API.embedded = 'tawk-embedded-chat';\n";
        }
        
        // Set position
        $script .= "Tawk_API.position = '{$position}';\n";
        
        // Auto show delay
        if ($autoShowDelay > 0) {
            $script .= "setTimeout(function() {\n";
            $script .= "  if (Tawk_API.maximize) {\n";
            $script .= "    Tawk_API.maximize();\n";
            $script .= "  }\n";
            $script .= "}, {$autoShowDelay} * 1000);\n";
        }
        
        $script .= "(function(){\n";
        $script .= "  var s1 = document.createElement('script'), s0 = document.getElementsByTagName('script')[0];\n";
        $script .= "  s1.async = true;\n";
        $script .= "  s1.src = 'https://embed.tawk.to/{$propertyId}/{$widgetId}';\n";
        $script .= "  s1.charset = 'UTF-8';\n";
        $script .= "  s1.setAttribute('crossorigin','*');\n";
        $script .= "  s0.parentNode.insertBefore(s1,s0);\n";
        $script .= "})();\n";
        $script .= "</script>\n";
        
        return $script;
    }

    private function getPositionCss(string $position): string
    {
        switch ($position) {
            case 'bottom-left':
                return 'bottom: 20px; left: 20px;';
            case 'top-right':
                return 'top: 20px; right: 20px;';
            case 'top-left':
                return 'top: 20px; left: 20px;';
            case 'bottom-right':
            default:
                return 'bottom: 20px; right: 20px;';
        }
    }

    private function sanitize(string $input): string
    {
        // XSS protection: escape HTML and remove dangerous characters
        return htmlspecialchars(strip_tags($input), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }
}