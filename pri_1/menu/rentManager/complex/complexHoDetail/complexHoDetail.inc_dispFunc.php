<?php
echo ___pageBreadcrumbs($_editDb['breadcrumbs']);
echo ___pageTitle($_editDb['mainTitle']);

echo ___table_hoInfo($_hoInfo,___pageSubTitle('계약정보'),VIEW_PANEL_TABLE);

echo ___table_hoContract($_hoInfo,___pageSubTitle('계약자'),VIEW_PANEL_TABLE);

echo ___table_hoContractHistory($_hoInfo,___pageSubTitle('계약이력'),VIEW_PANEL_TABLE);
