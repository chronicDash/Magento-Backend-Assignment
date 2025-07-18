<?php
namespace Yash\US22\Model\ResourceModel\Popup\Grid;

use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\Api\Search\AggregationInterface;
use Yash\US22\Model\ResourceModel\Popup\Collection as PageCollection;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Psr\Log\LoggerInterface;

class Collection extends PageCollection implements SearchResultInterface
{
    /**
     * @var TimezoneInterface
     */
    private TimezoneInterface $timeZone;

    /**
     * @var AggregationInterface
     */
    protected AggregationInterface $aggregations;

    /** @var string */
    private $resourceModel;

public function __construct(
    EntityFactoryInterface $entityFactory,
    LoggerInterface $logger,
    FetchStrategyInterface $fetchStrategy,
    ManagerInterface $eventManager,
    $mainTable,
    $eventPrefix,
    $eventObject,
    $resourceModel,
    TimezoneInterface $timeZone,
    $model = \Magento\Framework\View\Element\UiComponent\DataProvider\Document::class,
    AbstractDb $resource = null,
    \Magento\Framework\DB\Adapter\AdapterInterface $connection = null
) {
    $this->_eventPrefix = $eventPrefix;
    $this->_eventObject = $eventObject;
    $this->_init($model, $resourceModel);
    $this->setMainTable($mainTable);
    $this->timeZone = $timeZone;

    parent::__construct(
        $entityFactory,
        $logger,
        $fetchStrategy,
        $eventManager,
        $connection,
        $resource
    );
}


    /**
     * @inheritDoc
     */
    public function addFieldToFilter($field, $condition = null)
    {
        if ($field === 'created_at' || $field === 'updated_at') {
            if (is_array($condition)) {
                foreach ($condition as $key => $value) {
                    $condition[$key] = $this->timeZone->convertConfigTimeToUtc($value);
                }
            }
        }

        return parent::addFieldToFilter($field, $condition);
    }

    /**
     * Get aggregation interface instance
     *
     * @return AggregationInterface
     */
    public function getAggregations()
    {
        return $this->aggregations;
    }

    /**
     * Set aggregation interface instance
     *
     * @param AggregationInterface $aggregations
     * @return $this
     */
    public function setAggregations($aggregations)
    {
        $this->aggregations = $aggregations;
        return $this;
    }

    /**
     * Get search criteria.
     *
     * @return \Magento\Framework\Api\SearchCriteriaInterface|null
     */
    public function getSearchCriteria()
    {
        return null;
    }

    /**
     * Set search criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setSearchCriteria(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria = null)
    {
        return $this;
    }

    /**
     * Get total count.
     *
     * @return int
     */
    public function getTotalCount()
    {
        return $this->getSize();
    }

    /**
     * Set total count.
     *
     * @param int $totalCount
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setTotalCount($totalCount)
    {
        return $this;
    }

    /**
     * Set items list.
     *
     * @param \Magento\Framework\Api\ExtensibleDataInterface[] $items
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setItems(array $items = null)
    {
        return $this;
    }
}