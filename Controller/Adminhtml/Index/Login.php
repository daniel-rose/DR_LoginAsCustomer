<?php
namespace DR\LoginAsCustomer\Controller\Adminhtml\Index;

class Login extends \Magento\Backend\App\Action
{
    /**
     * Admin session model
     *
     * @var \Magento\Backend\Model\Auth\Session $_adminSession
     */
    protected $_adminSession;

    /**
     * Customer session model
     *
     * @var \Magento\Customer\Model\Session $_session
     */
    protected $_session;

    /**
     * Logger model
     *
     * @var \Psr\Log\LoggerInterface $_logger
     */
    protected $_logger;

    /**
     * Frontend url builder
     *
     * @var \Magento\Framework\UrlInterface $_frontendUrlBuilder
     */
    protected $_frontendUrlBuilder;

    /**
     * Construct
     *
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\UrlInterface $frontendUrlBuilder,
        \Magento\Customer\Model\Session $session,
        \Magento\Backend\Model\Auth\Session $adminSession,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::__construct($context);
        $this->_frontendUrlBuilder = $frontendUrlBuilder;
        $this->_adminSession = $adminSession;
        $this->_session = $session;
        $this->_logger = $logger;
    }


    /**
     * Is allowed
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('DR_LoginAsCustomer::login');
    }

    /**
     * Execute
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        $customerId = $this->getRequest()->getParam('id');

        $this->_session->logout();

        if ($customerId && $this->_session->loginById($customerId)) {
            if ($this->_adminSession->getUser() != null && $this->_adminSession->getUser()->getId()) {
                $this->_logger->info(sprintf('%s logged in as %s.', $this->_adminSession->getUser()->getUserName(),
                    $this->_session->getCustomer()->getName()));
            }

            $urlToCustomerAccount = $this->_frontendUrlBuilder->getUrl('customer/account/index');

            $resultRedirect->setUrl($urlToCustomerAccount);
        } else {
            $this->messageManager->addError(__('Could not login as given customer.'));
            $resultRedirect->setPath('*/*/*');
        }

        return $resultRedirect;
    }
}