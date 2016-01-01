<?php
namespace DR\LoginAsCustomer\Block\Adminhtml\Customer\Edit;

class LoginAsCustomerButton extends \Magento\Customer\Block\Adminhtml\Edit\GenericButton implements \Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface
{
    /**
     * @var \Magento\Customer\Api\AccountManagementInterface
     */
    protected $customerAccountManagement;

    /**
     * Constructor
     *
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Customer\Api\AccountManagementInterface $customerAccountManagement
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Customer\Api\AccountManagementInterface $customerAccountManagement
    ) {
        parent::__construct($context, $registry);
        $this->customerAccountManagement = $customerAccountManagement;
    }

    /**
     * Retrieve button data
     *
     * @return array
     */
    public function getButtonData()
    {
        $customerId = $this->getCustomerId();
        $canModify = $customerId && !$this->customerAccountManagement->isReadonly($this->getCustomerId());
        $data = [];
        if ($customerId && $canModify) {
            $data = [
                'label' => __('Login As Customer'),
                'on_click' => sprintf("location.href = '%s';", $this->getLoginAsCustomerUrl()),
                'class' => 'add',
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    /**
     * Retrieve login as customer url
     *
     * @return string
     */
    public function getLoginAsCustomerUrl()
    {
        return $this->getUrl('dr_loginascustomer/index/login', ['id' => $this->getCustomerId()]);
    }
}
