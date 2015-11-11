# Aoe_CacheStats

This Magento module gathers cache statistics and writes them into a log file (buffered).

Author: [Fabrizio Branca](https://twitter.com/fbrnc)

### Example:
```
2015-11-11T04:48:06+0000,8421,m,config_global.lock,0
2015-11-11T04:48:06+0000,8421,h,config_global,4
2015-11-11T04:48:07+0000,8421,m,app_4e4abdd8dc00c3dacb3c1597944a3b6c,0
2015-11-11T04:48:07+0000,8421,s,app_4e4abdd8dc00c3dacb3c1597944a3b6c,2
2015-11-11T04:48:07+0000,8421,m,store_admin_config_cache,0
2015-11-11T04:48:07+0000,8421,h,config_global_stores_admin,1
2015-11-11T04:48:07+0000,8421,s,store_admin_config_cache,2
2015-11-11T04:48:07+0000,8421,m,app_b1fb6e8f13287c01e5c05063633dda4c,0
2015-11-11T04:48:07+0000,8421,s,app_b1fb6e8f13287c01e5c05063633dda4c,1
2015-11-11T04:48:07+0000,8421,m,app_e4d52b98688947405ede639e947ee03d,0
2015-11-11T04:48:07+0000,8421,s,app_e4d52b98688947405ede639e947ee03d,2
2015-11-11T04:48:07+0000,8421,m,store_ca_en_config_cache,0
2015-11-11T04:48:07+0000,8421,h,config_global_stores_ca_en,1
```

### Format
* Timestamp in DATE_ISO8601 format
* Process ID
* Type
  * h: hit
  * m: miss
  * s: save
  * r: remove
  * f: flush
  * c: clean
* id (or semicolon separated tags when cleaning)
* duration in milliseconds
        