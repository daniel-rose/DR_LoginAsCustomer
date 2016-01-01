<?php
namespace DR\LoginAsCustomer\Ui\Component\Listing\Column;

class Actions extends \Magento\Customer\Ui\Component\Listing\Column\Actions
{
    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $storeId = $this->context->getFilterParam('store_id');

            foreach ($dataSource['data']['items'] as &$item) {
                $item[$this->getData('name')]['edit'] = [
                    'href' => $this->urlBuilder->getUrl(
                        'customer/*/edit',
                        ['id' => $item['entity_id'], 'store' => $storeId]
                    ),
                    'label' => __('Edit'),
                    'hidden' => false,
                ];

                $item[$this->getData('name')]['login_as_customer'] = [
                    'href' => $this->urlBuilder->getUrl(
                        'dr_loginascustomer/index/login',
                        ['id' => $item['entity_id']]
                    ),
                    'label' => __('Login As Customer'),
                    'hidden' => false,
                ];
            }
        }

        return $dataSource;
    }
}