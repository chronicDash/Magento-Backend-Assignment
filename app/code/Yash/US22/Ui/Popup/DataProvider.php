<?php
namespace Yash\US22\Ui\Popup;

use Yash\US22\Model\ResourceModel\Popup\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\ModifierPoolDataProvider
{
    /**
     * @var \Yash\US22\Model\ResourceModel\Popup\Collection
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData = [];

    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $blockCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     * @param PoolInterface|null $pool
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $blockCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = [],
        PoolInterface $pool = null
    ) {
        $this->collection = $blockCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data, $pool);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (!empty($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        /** @var \Yash\US22\Model\Popup $popup */
        foreach ($items as $popup) {
            $this->loadedData[$popup->getId()] = $popup->getData();
        }

        $data = $this->dataPersistor->get('us22');
        if (!empty($data)) {
            $poup = $this->collection->getNewEmptyItem();
            $popup->setData($data);
            $this->loadedData[$popup->getId()] = $popup->getData();
            $this->dataPersistor->clear('us22');
        }

        return $this->loadedData;
    }
}