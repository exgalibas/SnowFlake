# SnowFlake
SnowFlake算法 PHP实现
该算法由Twitter开发并开源，官方给出的是scala代码，本版本是基于PHP开发，原理一样

# 算法描述
官方给出的是64bit位表示id，其中41位表示时间戳，10位表示机器id，12位表示同秒级序列号

# 说明
1. config中提供更灵活的配置，除去时间戳位和序列号位，中间的可以通过segment灵活配置，segment中子元素的第一个是分配的位数，第二个是值，可与机房、机器进行对应，config中也给出了一些默认值，可自行修改
2. SnowFlake是PHP代码的实现，有一些非法点的check
3. example包含几个使用的小例子
