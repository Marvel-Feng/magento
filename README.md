# Magento Module & API Integration

### Installation and Setup
Initially I tried to use Docker to develop/deploy Magento2, but it's extremely slow (20s+ requests)

I followed this guide using MAMP Pro http://paulmestereaga.com/install-magento-2-locally-mamp/


### Magento 2 Custom Module with API Support
All code for the module is located in : https://github.com/garrettvorce/magento/tree/master/app/code/Products/BestSellers

Using Magento 2's Factory and Collection creators you can pull various reports and data about products
Code here: https://github.com/garrettvorce/magento/blob/master/app/code/Products/BestSellers/Model/BestSellers.php

Similarly to Laravel, Magento has a nice ORM to map data and filter by amounts (of products per page), date ranges, offsetting, etc)


### Creating a Best Seller Collection
In the backend of the Magento 2, I manually created a few orders and then re-ran the report for the products to show in the collection

### API Integration

Self-explanatory -- the resource ref="anonymous" allows for guests or outside requests to retrieve this collection information, otherwise authorization methods are required

`fromDate` and `toDate` are required parameters for the date range

`:size` refers to the amount of items to be listed in the response

```
<?xml version="1.0"?>
<routes xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:noNamespaceSchemaLocation="urn:magento:module:Magento_Webapi:etc/webapi.xsd">
    <route url="/V1/products/bestsellers/:size" method="GET">
        <service class="Products\BestSellers\Api\BestSellerInterface" method="get"/>
        <resources>
            <resource ref="anonymous"/>
        </resources>
        <data>
            <parameter name="offset" force="false">%pageSize%</parameter>
            <parameter name="offset" force="false">%offset%</parameter>
            <parameter name="sort" force="false">%sort%</parameter>
            <parameter name="fromDate" force="true">%fromDate%</parameter>
            <parameter name="toDate" force="true">%toDate%</parameter>
        </data>
    </route>
</routes>
```
