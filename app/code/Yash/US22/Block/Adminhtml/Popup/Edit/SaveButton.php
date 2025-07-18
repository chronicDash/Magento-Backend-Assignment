<?php
namespace Yash\US22\Block\Adminhtml\Popup\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveButton extends GenericButton implements ButtonProviderInterface
{
    public function getButtonData()
    {
        return [
            'label' => __('Save'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'yash_us22_form.yash_us22_form',
                                'actionName' => 'save',
                            ]
                        ]
                    ]
                ]
            ],
        ];
    }
}
