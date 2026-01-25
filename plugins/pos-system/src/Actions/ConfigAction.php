<?php

declare(strict_types=1);

namespace Mojahid\PosSystem\Actions;

use MojarCMS\CMS\Abstracts\Action;
use MojarCMS\CMS\Facades\HookAction;

final class ConfigAction extends Action
{
    public function handle(): void
    {
        $this->addAction(Action::INIT_ACTION, [$this, 'registerConfigs']);
    }

    public function registerConfigs(): void
    {
        HookAction::registerConfig([
            'pos_tax_rate' => [
                'label' => 'Tax Rate (%)',
                'type' => 'number',
                'default' => 0,
            ],
            'pos_receipt_footer' => [
                'label' => 'Receipt Footer Text',
                'type' => 'textarea',
                'default' => 'Thank you for your business!',
            ],
            'pos_auto_print_receipt' => [
                'label' => 'Auto Print Receipt',
                'type' => 'checkbox',
                'default' => true,
            ],
            'pos_hold_order_limit' => [
                'label' => 'Hold Order Limit',
                'type' => 'number',
                'default' => 50,
            ],
            'pos_default_customer_name' => [
                'label' => 'Default Customer Name',
                'type' => 'text',
                'default' => 'Walk-in Customer',
            ],
        ]);
    }
} 