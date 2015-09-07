<?php
namespace DR\LoginAsCustomer\Controller\Adminhtml\Index;

class Login extends \Magento\Backend\App\Action
{
    /**
     * Customer session model
     *
     * @var \Magento\Customer\Model\Session $session
     */
    protected $_session;

    /**
     * Frontend url builder
     *
     * @var \Magento\Framework\UrlInterface $_frontendUrlBuilder
     */
    protected $_frontendUrlBuilder;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\UrlInterface $frontendUrlBuilder,
        \Magento\Customer\Model\Session $session
    )
    {
        parent::__construct($context);
        $this->_frontendUrlBuilder = $frontendUrlBuilder;
        $this->_session = $session;
    }


    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('DR_LoginAsCustomer::dashboard');
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    protected function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        $customerId = $this->getRequest()->getParam('id');

        if($customerId && $this->_session->loginById($customerId)) {
            $urlToCustomerAccount = $this->_frontendUrlBuilder->getUrl('customer/account/index');

            $resultRedirect->setUrl($urlToCustomerAccount);
        } else {
            $this->messageManager->addError(__('Could not login as given customer.'));
            $resultRedirect->setPath('*/*/*');
        }

        return $resultRedirect;
    }
}