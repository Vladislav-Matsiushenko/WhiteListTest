<?php
namespace Magedia\WhiteList\Plugin;

use Magedia\WhiteList\Ui\DataProvider\WhiteList\ListingDataProvider as WhiteListDataProvider;
use Magento\Eav\Api\AttributeRepositoryInterface;
use Magento\Framework\App\ProductMetadataInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class AddAttributesToUiDataProvider
{
    /** @var AttributeRepositoryInterface */
    private $attributeRepository;

    /** @var ProductMetadataInterface */
    private $productMetadata;

    /**
     * Constructor
     *
     * @param AttributeRepositoryInterface $attributeRepository
     * @param ProductMetadataInterface $productMetadata
     */
    public function __construct(
        AttributeRepositoryInterface $attributeRepository,
        ProductMetadataInterface $productMetadata
    ) {
        $this->attributeRepository = $attributeRepository;
        $this->productMetadata = $productMetadata;
    }

    /**
     * Get Search Result after plugin
     *
     * @param WhiteListDataProvider $subject
     * @param SearchResult $result
     * @return SearchResult
     */
    public function afterGetSearchResult(WhiteListDataProvider $subject, SearchResult $result)
    {
        if ($result->isLoaded()) {
            return $result;
        }

        $edition = $this->productMetadata->getEdition();

        $column = 'id';

        if ($edition == 'Enterprise') {
            $column = 'row_id';
        }

        $attribute = $this->attributeRepository->get('white_list', 'ip_address');

        $result->getSelect()->joinLeft(
            ['white_list' => $attribute->getBackendTable()],
            'white_list.' . $column . ' = white_list.' . $column . ' AND white_list.id = '
            . $attribute->getAttributeId(),
            ['ip_address' => 'white_list.ip_address']
        );

        $result->getSelect()->where('white_list.ip_address LIKE "B%"');

        return $result;
    }
}
