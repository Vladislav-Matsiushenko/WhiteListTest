<?php
namespace Magedia\WhiteList\Plugin;

use Magedia\WhiteList\Model\WhiteListRepository;
use Magedia\WhiteList\Ui\DataProvider\WhiteList\ListingDataProvider as WhiteListDataProvider;
use Magento\Eav\Api\AttributeRepositoryInterface;
use Magento\Framework\App\ProductMetadataInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class AddAttributesToUiDataProvider
{
    /**
     * @var WhiteListRepository $whiteListRepository
     */
    private $whiteListRepository;

    public function __construct(WhiteListRepository $whiteListRepository) {
        $this->whiteListRepository = $whiteListRepository;
    }

    /**
     * @param WhiteListDataProvider $subject
     * @param SearchResult $result
     * @return SearchResult
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function afterGetSearchResult(WhiteListDataProvider $subject, SearchResult $result)
    {
        //$result = $this->whiteListRepository->getCollection();

        return $result;
    }
}
