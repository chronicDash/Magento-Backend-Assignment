<?php
namespace Yash\US23\Block;

use Magento\Checkout\Block\Checkout\AttributeMerger;
use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;
use Magento\Customer\Model\AttributeMetadataDataProvider;
use Magento\Ui\Component\Form\AttributeMapper;

class LayoutProcessor implements LayoutProcessorInterface
{
    public function __construct(
        private readonly AttributeMetadataDataProvider $attributeMetadataDataProvider,
        private readonly AttributeMapper $attributeMapper,
        private readonly AttributeMerger $attributeMerger
    ) {
    }

    public function process($jsLayout) {
        $elements = $this->getAddressAttributes();
        $fields = &$jsLayout['components']['checkout']['children']['steps']['children']['contact-step']['children']['contact']['children']['contact-fieldset']['children'];

        $fieldCodes = array_keys($fields);
        $elements = array_filter($elements, function ($key) use ($fieldCodes) {
            return in_array($key, $fieldCodes);
        }, ARRAY_FILTER_USE_KEY);

        $fields = $this->attributeMerger->merge(
            $elements,
            'checkoutProvider',
            'contact',
            $fields
        );
        return $jsLayout;
    }
    public function getAddressAttributes() {
        $attributes = $this->attributeMetadataDataProvider->loadAttributesCollection('customer_address', 'customer_register_address');
        $elements = [];
        foreach($attributes as $attribute) {
            $code = $attribute->getAttributeCode();
            $elements[$code] = $this->attributeMapper->map($attribute);
            if(isset($elements[$code]['label'])) {
                $label = $elements[$code]['label'];
                $elements[$code]['label'] = __($label);
            }
        }

        return $elements;
    }
}
