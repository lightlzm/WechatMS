# WechatMS
微信管理系统 - 客户端(WeChat management system)

一、简介
    
    可视化管理微信机器人，包含管理微信号、管理微信群、微信多群区分等功能。

二、功能说明：

    1、微信管理 
       1.1、好友请求（自动通过添加，通过后自动回复）
       1.2、关键字自动回复（支持文字、图片、图文、加群）

    2、微信群管理 
       2.1、新群开通
       2.2、群列表
       2.3、群成员
       2.4、入群欢迎
       2.5、群公告
       2.6、关键字自动回复

    3、群发
       3.1、即时群发（支持文字、图片、图文）
       3.2、定时群发（支持定时或重复日期群发）

三、安装
    
    1、安装服务器环境 php+apche+mysql
        windows可以下载 WampServer 三合一安装软件包安装
        Linux 可安装 XAMPP 集成软件包

    2、把项目WechatMS文件复制到本地虚拟目录

    3、打开config.php 配置数据库参数、虚拟目录host

    4、浏览器运行 http://localhost/WechatMS/install.php 完成安装


四、 启动Wechaty服务器端
 
     详情见：https://github.com/lightlzm/WechatMS_SERV


五、进入系统

    浏览器打开 http://localhost/WechatMS/index.php  
    
   （按上面第四点：启动Wechaty服务器端，进入系统才能看到数据哦）


