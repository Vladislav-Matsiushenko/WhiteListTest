<?php

declare(strict_types=1);

namespace Magedia\WhiteList\Model;

use Magedia\WhiteList\Api\WhiteListRepositoryInterface;
use Magedia\WhiteList\Model\ResourceModel\WhiteList as WhiteListResource;
use Magedia\WhiteList\Model\ResourceModel\WhiteList\Collection as WhiteListCollection;
use Magedia\WhiteList\Model\WhiteListFactory as WhiteListFactory;
use Magedia\WhiteList\Model\ResourceModel\WhiteList\CollectionFactory as WhiteListCollectionFactory;
use Magento\Framework\App\ObjectManager;

class WhiteListRepository implements WhiteListRepositoryInterface
{
    public const SESSION_KEY = 'WhiteList';
    public const SESSION_VALUE = 1;

    /**
     * @var WhiteListFactory $whiteListFactory
     */
    private $whiteListFactory;

    /**
     * @var WhiteListCollectionFactory $whiteListCollectionFactory
     */
    private $whiteListCollectionFactory;

    /**
     * @param WhiteListFactory $whiteListFactory
     * @param WhiteListCollectionFactory $whiteListCollectionFactory
     */
    public function __construct(WhiteListFactory           $whiteListFactory,
                                WhiteListCollectionFactory $whiteListCollectionFactory)
    {
        $this->whiteListFactory = $whiteListFactory;
        $this->whiteListCollectionFactory = $whiteListCollectionFactory;
    }

    /**
     * @return bool
     */
    public function inWhiteList(): bool
    {
        $objectManager = ObjectManager::getInstance();
        $remote = $objectManager->get('Magento\Framework\HTTP\PhpEnvironment\RemoteAddress');
        $ipAddress = $remote->getRemoteAddress();

        $collection = $this->whiteListCollectionFactory->create();

        foreach ($collection as $a) {
            if ($a->getIpAddress() === $ipAddress) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param int[] $ids
     * @return int
     */
    public function delete($ids): int
    {
        $deleted = 0;
        foreach ($ids as $id) {
            $item = $this->whiteListFactory->create()->load($id);
            $item->delete();
            $deleted++;
        }

        return $deleted;
    }

    /**
     * @param[] $data
     * @return void
     */
    public function save($data): void
    {
        $item = $this->whiteListFactory->create();
        $item->setData($data);
        $item->save();
    }
}
