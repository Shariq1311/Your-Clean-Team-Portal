<?php

namespace Mojahid\MojarCompanion\Actions;

use MojarCMS\CMS\Abstracts\Action;
use MojarCMS\CMS\Facades\HookAction;

class MojarCompanionAction extends Action
{
    public function handle(): void
    {
        $this->addAction(
            Action::INIT_ACTION,
            [$this, 'registerPostTypes']
        );
        
        // Register the dashboard view hook
        $this->addAction(
            'backend.dashboard.view',
            [$this, 'registerDashboardView']
        );
    }


    /**
     * Register dashboard widgets for the Mojar CMS dashboard
     *
     * @return void
     */
    public function registerDashboardView(): void
    {
        // Use the DashboardController to handle the dashboard views
        app('Mojahid\MojarCompanion\Http\Controllers\Backend\DashboardController')->registerDashboardView();
    }

    public function registerPostTypes(): void
    {
        // Team
        HookAction::registerPostType(
            'teams',
            [
                'label' => trans('Mojar::content.teams'),
                'description' => trans('Mojar::content.teams_description'),
                'menu_icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 1 -3 -4" /></svg>',
                'menu_position' => 10,
                'supports' => [
                    'title',
                    'editor',
                    'excerpt',
                    'thumbnail',
                ],
                'metas' => [
                    // Basic Info
                    'position' => [
                        'type' => 'text',
                        'label' => __('Position/Job Title'),
                        'description' => __('e.g., CEO & Founder, UI/UX Designer, etc.'),
                        'required' => true
                    ],
                    'department' => [
                        'type' => 'text',
                        'label' => __('Department/Team'),
                        'description' => __('Department or team the member belongs to')
                    ],
                    'subtitle' => [
                        'type' => 'text',
                        'label' => __('Professional Subtitle'),
                        'description' => __('e.g., Professional UI/UX Design, Software Development Expert')
                    ],
                    
                    // Images
                    'skill_image' => [
                        'type' => 'image',
                        'label' => __('Skill Image'),
                        'description' => __('Skill image for the team member')
                    ],
                    'employment_type' => [
                        'type' => 'select',
                        'label' => __('Employment Type'),
                        'data' => [
                            'options' => [
                                'Full-time' => __('Full-time'),
                                'Part-time' => __('Part-time'),
                                'Contract' => __('Contract'),
                                'Freelance' => __('Freelance'),
                                'Intern' => __('Intern'),
                                'Consultant' => __('Consultant')
                            ]
                        ]
                    ],
                    
                    // Contact Information
                    'location' => [
                        'type' => 'text',
                        'label' => __('Office Location'),
                        'description' => __('e.g., 1629 N. Dixie Avenue, Kentucky, 42701')
                    ],
                    'email' => [
                        'type' => 'email',
                        'label' => __('Email Address'),
                        'description' => __('Professional email address')
                    ],
                    'phone' => [
                        'type' => 'text',
                        'label' => __('Phone Number'),
                        'description' => __('Primary phone number')
                    ],
                    'mobile' => [
                        'type' => 'text',
                        'label' => __('Mobile Number'),
                        'description' => __('Mobile phone number')
                    ],
                    
                    // Office Hours
                    'office_hours' => [
                        'type' => 'textarea',
                        'label' => __('Office Hours'),
                        'description' => __('e.g., Sunday - Friday, 10:00 AM - 5:00 PM')
                    ],
                    
                    // Experience
                    'years_experience' => [
                        'type' => 'text',
                        'label' => __('Years of Experience'),
                        'description' => __('Total years of professional experience')
                    ],
                    'experience_title' => [
                        'type' => 'text',
                        'label' => __('Experience Title'),
                        'description' => __('e.g., crafting intuitive, building solutions')
                    ],
                    'experience_description' => [
                        'type' => 'textarea',
                        'label' => __('Experience Description'),
                        'description' => __('Brief description of experience focus')
                    ],
                    'expertise_image' => [
                        'type' => 'image',
                        'label' => __('Expertise Image'),
                        'description' => __('Expertise image for the team member')
                    ],
                    
                    // Skills & Expertise
                    'expertise' => [
                        'type' => 'textarea',
                        'label' => __('Areas of Expertise'),
                        'description' => __('Format: Skill Name:Percentage, e.g. "User research:95, Product Design:80, Prototype & Launch:85"')
                    ],
                    'skills_title' => [
                        'type' => 'text',
                        'label' => __('Skills Section Title'),
                        'description' => __('e.g., Design Skills Hub, Technical Expertise')
                    ],
                    'skills_description' => [
                        'type' => 'textarea',
                        'label' => __('Skills Description'),
                        'description' => __('Description of skills and expertise')
                    ],
                    
                    // Display Options
                    'show_social_links' => [
                        'type' => 'checkbox',
                        'label' => __('Show Social Links'),
                        'description' => __('Display social media links on profile'),
                        'default' => true
                    ],

                    // Social Media Links
                    'facebook' => [
                        'type' => 'text',
                        'label' => __('Facebook Profile'),
                        'description' => __('Facebook profile or page URL')
                    ],
                    'linkedin' => [
                        'type' => 'text',
                        'label' => __('LinkedIn Profile'),
                        'description' => __('LinkedIn profile URL')
                    ],
                    'dribbble' => [
                        'type' => 'text',
                        'label' => __('Dribbble Profile'),
                        'description' => __('Dribbble profile URL')
                    ],
                ]
            ]
        ); 

        // portfolio
        HookAction::registerPostType(
            'portfolios',
            [
                'label' => trans('Mojar::content.portfolios'),
                'menu_icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-book"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0" /><path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0" /><path d="M3 6l0 13" /><path d="M12 6l0 13" /><path d="M21 6l0 13" /></svg>',
                'menu_position' => 10,
                    'supports' => [
                        'thumbnail',
                        'category',
                    ],
                'metas' => [
                    'excerpt' => [
                        'type' => 'textarea',
                        'label' => __('Portfolio Excerpt')
                    ],
                    'portfolio_link_title' => [
                        'type' => 'text',
                        'label' => __('Portfolio Link Title')
                    ],
                    'portfolio_link' => [
                        'type' => 'text',
                        'label' => __('Portfolio Link')
                    ],
                    'meta_list' => [
                        'type' => 'repeater',
                        'label' => __('Meta List'),
                        'name' => "meta_list",
                        'fields' => [
                            'content_icon' => [
                                'type' => 'text',
                                'name' => "content_icon",
                                'label' => __('Content Icon'),
                            ],
                            'content_title' => [
                                'type' => 'text',
                                'name' => "content_title",
                                'label' => __('Content Title'),
                            ],
                            'content_value' => [
                                'type' => 'text',
                                'name' => "content_value",
                                'label' => __('Content Value'),
                            ],
                        ]
                    ]
                ]
            ]
        );

        // testimonials
        HookAction::registerPostType(
            'testimonials',
            [
                'label' => trans('Mojar::content.testimonials'),
                'menu_icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4" /><path d="M15 19l2 2l4 -4" /></svg>',
                'menu_position' => 10,
                'metas' => [
                    'name' => [
                        'type' => 'text',
                        'label' => __('Name'),
                    ],
                    'position' => [
                        'type' => 'text',
                        'label' => __('Position'),
                    ],
                    'rating' => [
                        'type' => 'select',
                        'label' => __('Rating'),
                        'description' => __('This will be used to sort the menu items'),
                        'data' => [
                            'default' => '1',
                            'options' => [
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5'
                            ]
                        ]
                    ]
                ]
            ]
        );

        // faqs
        HookAction::registerPostType(
            'faqs',
            [
                'label' => trans('Mojar::content.faqs'),
                'menu_icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-help-octagon"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12.802 2.165l5.575 2.389c.48 .206 .863 .589 1.07 1.07l2.388 5.574c.22 .512 .22 1.092 0 1.604l-2.389 5.575c-.206 .48 -.589 .863 -1.07 1.07l-5.574 2.388c-.512 .22 -1.092 .22 -1.604 0l-5.575 -2.389a2.036 2.036 0 0 1 -1.07 -1.07l-2.388 -5.574a2.036 2.036 0 0 1 0 -1.604l2.389 -5.575c.206 -.48 .589 -.863 1.07 -1.07l5.574 -2.388a2.036 2.036 0 0 1 1.604 0z" /><path d="M12 16v.01" /><path d="M12 13a2 2 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483" /></svg>',
                'menu_position' => 10,
                'supports' => [
                    'thumbnail',
                    'category',
                ],
                'metas' => [
                    'is_active' => [
                        'type' => 'select',
                        'label' => __('Is Active'),
                        'description' => __('Is Active'),
                        'data' => [
                            'default' => 'true',
                            'options' => [
                                'true' => 'True',
                                'false' => 'False'
                            ]
                        ]
                    ]
                ]
            ]
        );

         // pricing
         HookAction::registerPostType(
            'pricing',
            [
                'label' => trans('Mojar::content.pricing'),
                'menu_icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-packages"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" /><path d="M2 13.5v5.5l5 3" /><path d="M7 16.545l5 -3.03" /><path d="M17 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" /><path d="M12 19l5 3" /><path d="M17 16.5l5 -3" /><path d="M12 13.5v-5.5l-5 -3l5 -3l5 3v5.5" /><path d="M7 5.03v5.455" /><path d="M12 8l5 -3" /></svg>',
                'menu_position' => 10,
                'metas' => [
                    'price' => [
                        'type' => 'text',
                        'label' => __('Price'),
                    ],
                    'annual_price' => [
                        'type' => 'text',
                        'label' => __('Annual Price'),
                    ],
                    'annual_price_description' => [
                        'type' => 'textarea',
                        'label' => __('Annual Price Description'),
                    ],
                    'price_button_text' => [
                        'type' => 'text',
                        'label' => __('Price Button Text'),
                    ],
                    'price_button_url' => [
                        'type' => 'text',
                        'label' => __('Price Button URL'),
                    ],
                    'is_populer' => [
                        'type' => 'checkbox_json',
                        'label'=> __('Is Populer'),
                        'data' => [
                            'value' => 1
                        ]
                    ],
                    'features_list' => [
                        'type' => 'repeater',
                        'label' => __('Features List'),
                        'name' => "features_list",
                        'fields' => [
                            'features_title' => [
                                'type' => 'text',
                                'name' => "features_title",
                                'label' => __('Features Title'),
                            ],
                            'features_active' => [
                                'type' => 'checkbox_json',
                                'label'=> __('Features Active'),
                                'name' => "features_active",
                                'data' => [
                                    'value' => 1
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        );


        // services
        HookAction::registerPostType(
            'services',
            [
                'label' => trans('Mojar::content.services'),
                'menu_icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-settings-share"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12.004 21c-.732 .002 -1.466 -.437 -1.679 -1.317a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.306 .317 1.64 1.78 1.004 2.684" /><path d="M12 15a3 3 0 1 0 0 -6a3 3 0 0 0 0 6z" /><path d="M16 22l5 -5" /><path d="M21 21.5v-4.5h-4.5" /></svg>',
                'menu_position' => 10,
                'supports' => [
                    'thumbnail',
                    'category',
                ],
                'metas' => [
                    'features_list' => [
                        'type' => 'repeater',
                        'label' => __('Meta List'),
                        'name' => "features_list",
                        'fields' => [
                            'features_title_1' => [
                                'type' => 'text',
                                'name' => "features_title_1",  
                                'label' => __('Features Title 1'),
                            ],
                            'features_title_2' => [
                                'type' => 'text',
                                'name' => "features_title_2",
                                'label' => __('Features Title 2'),
                            ]
                        ]
                    ]
                ]
            ]
        );

        // addMetaPostTypes 
        HookAction::addMetaPostTypes('pages', [
            'header_style' => [  
                'type' => 'select',
                'label' => __('Header Style'),  
                'description' => __('This will be used to sort the menu items'),
                'data' => [
                    'default' => 'header-1',
                    'options' => [
                        'header-1' => 'Header 1',
                        'header-2' => 'Header 2'
                    ]
                ]
                    ],
            'footer_style' => [ 
                'type' => 'select',
                'label' => __('Footer Style'),
                'description' => __('This will be used to sort the menu items'),
                'data' => [
                    'default' => 'footer-1',
                    'options' => [
                        'footer-1' => 'Footer 1',
                        'footer-2' => 'Footer 2'
                    ]
                ]
                    ],
        ]);
    }
}
