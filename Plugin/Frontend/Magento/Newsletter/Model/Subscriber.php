<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace PixieMedia\NoSubscribeEmail\Plugin\Frontend\Magento\Newsletter\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Subscriber
{
    const XML_IS_DISABLED = 'nosubscribeemail/options/is_disabled';

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->_scopeConfig = $scopeConfig;
    }

    /**
     * @param \Magento\Newsletter\Model\Subscriber $subject
     * @return void
     */
    public function beforeSendConfirmationSuccessEmail(
        \Magento\Newsletter\Model\Subscriber $subject
    ) {
        if ($this->_scopeConfig->isSetFlag(self::XML_IS_DISABLED, ScopeInterface::SCOPE_STORE)) {
            return $subject->setImportMode(true);
        }
    }
}
