<div class="menu-item-wrap">
    
    <div class="menu-item extend on">
        <div class="menu-title">微信管理</div>
        <!-- 二级 -->
        <div class="sub-menu"> 
            <div><a class="<? echo menu("botlist");?>" href="index.php?action=botlist">小助手</a></div>  
            <div><a class="<? echo menu("add_friend");?>" href="index.php?action=add_friend&bid=<? echo $bid;?>">好友请求</a></div>  
            <div><a class="<? echo menu("add_auto_reply,auto_reply");?>" href="index.php?action=auto_reply&bid=<? echo $bid;?>">自动回复</a></div>  
            <!-- 
            <div><a href="groupList.html">群发图片管理</a></div> 
            <div><a href="groupList.html">自动加群功能</a></div> 
            <div><a href="groupList.html">群成员活跃管理</a></div>  
             
            
            <div><a href="groupList.html">广告监控管理</a></div>  
            <div><a href="groupList.html">群公告管理</a></div>
            --> 
        </div>
    </div>


    <div class="menu-item extend on">
        <div class="menu-title">群管理</div>
        <!-- 二级 -->
        <div class="sub-menu">
            <div><a class="<? echo menu("claim_chatroom");?>" href="index.php?action=claim_chatroom&bid=<? echo $bid;?>">新群开通</a></div>
            <div><a class="<? echo menu("chatroom_list");?>" href="index.php?action=chatroom_list&bid=<? echo $bid;?>">群列表</a></div>
            <div><a class="<? echo menu("room_member,room_member_calendar");?>" href="index.php?action=room_member&bid=<? echo $bid;?>">群成员</a></div>  
            <div><a class="<? echo menu("room_welcome_message");?>" href="index.php?action=room_welcome_message&bid=<? echo $bid;?>">入群欢迎</a></div> 
            <div><a class="<? echo menu("room_announce");?>" href="index.php?action=room_announce&bid=<? echo $bid;?>">群公告</a></div> 
            <div><a class="<? echo menu("room_add_auto_reply,room_auto_reply");?>" href="index.php?action=room_auto_reply&bid=<? echo $bid;?>">自动回复</a></div> 
            <!-- 
            <div><a href="groupList.html">群发图片管理</a></div> 
            <div><a href="groupList.html">自动加群功能</a></div> 
            <div><a href="groupList.html">群成员活跃管理</a></div>  
             
            
            <div><a href="groupList.html">广告监控管理</a></div>  
            <div><a href="groupList.html">群公告管理</a></div>
            --> 
        </div>
    </div>
    
    <div class="menu-item extend on">
        <div class="menu-title">群发</div>
        <!-- 二级 -->
        <div class="sub-menu"> 
            <div><a class="<? echo menu("room_send_message");?>" href="index.php?action=room_send_message&bid=<? echo $bid;?>">即时群发</a></div> 
            <div><a class="<? echo menu("room_send_message_timeing,room_send_message_timeing_list");?>" href="index.php?action=room_send_message_timeing_list&bid=<? echo $bid;?>">定时群发</a></div>  
            
        </div>
    </div>

    <div class="menu-item extend" style="display:none;">
        <div class="menu-title">高级模块</div>
        <div class="sub-menu">
            <div><a href="groupList.html">好友信息群发</a></div>
            <div><a href="groupList.html">朋友圈转发图文</a></div> 
            <div><a href="groupList.html">朋友圈发图片/文字</a></div> 
            <div><a href="groupList.html">群发小程序卡片</a></div> 
            <div><a href="groupList.html">自动拉群功能</a></div>  
            <div><a href="groupList.html">群信息记录功能</a></div>  
            <div><a href="groupList.html">好友朋友圈记录功能</a></div>  
        </div>
    </div>

    <div class="menu-item extend" style="display:none;">
        <div class="menu-title">小程序模块</div>
        <div class="sub-menu">
            <div><a href="groupList.html">小程序图文功能</a></div>
            <div><a href="groupList.html">小程序统计功能</a></div> 
            <div><a href="groupList.html">小程序商城功能</a></div> 
            <div><a href="groupList.html">小程序商城统计</a></div>  
        </div>
    </div>

</div>
