@extends("layout.layout")
@section("content")
    <center><font color="red" size="2">{{session("msg")}}</font></center>
<div class="rt_content">
    <!--开始：以下内容则可删除，仅为素材引用参考-->
    <!--点击加载-->
    <script>
        $(document).ready(function(){
            $("#loading").click(function(){
                $(".loading_area").fadeIn();
                $(".loading_area").fadeOut(1500);
            });
        });
    </script>
    <section class="loading_area">
        <div class="loading_cont">
            <div class="loading_icon"><i></i><i></i><i></i><i></i><i></i></div>
            <div class="loading_txt"><mark>数据正在加载，请稍后！</mark></div>
        </div>
    </section>
    <!--结束加载-->
    <!--弹出框效果-->
    <script>
        $(document).ready(function(){
            //弹出文本性提示框
            $("#showPopTxt").click(function(){
                $(".pop_bg").fadeIn();
            });
            //弹出：确认按钮
            $(".trueBtn").click(function(){
                alert("你点击了确认！");//测试
                $(".pop_bg").fadeOut();
            });
            //弹出：取消或关闭按钮
            $(".falseBtn").click(function(){
                alert("你点击了取消/关闭！");//测试
                $(".pop_bg").fadeOut();
            });
        });
    </script>
    <section class="pop_bg">
        <div class="pop_cont">
            <!--title-->
            <h3>弹出提示标题</h3>
            <!--content-->
            <div class="pop_cont_input">
                <ul>
                    <li>
                        <span>标题</span>
                        <input type="text" placeholder="定义提示语..." class="textbox"/>
                    </li>
                    <li>
                        <span class="ttl">城市</span>
                        <select class="select">
                            <option>选择省份</option>
                        </select>
                        <select class="select">
                            <option>选择城市</option>
                        </select>
                        <select class="select">
                            <option>选择区/县</option>
                        </select>
                    </li>
                    <li>
                        <span class="ttl">地址</span>
                        <input type="text" placeholder="定义提示语..." class="textbox"/>
                    </li>
                    <li>
                        <span class="ttl">地址</span>
                        <textarea class="textarea" style="height:50px;width:80%;"></textarea>
                    </li>
                </ul>
            </div>
            <!--以pop_cont_text分界-->
            <div class="pop_cont_text">
                这里是文字性提示信息！
            </div>
            <!--bottom:operate->button-->
            <div class="btm_btn">
                <input type="button" value="确认" class="input_btn trueBtn"/>
                <input type="button" value="关闭" class="input_btn falseBtn"/>
            </div>
        </div>
    </section>
    <section>
        <h2><strong style="color:grey;">微信公众号关注列表</strong></h2>
        <div class="page_title">
            <h2 class="fl">已关注用户</h2>
            <a class="fr top_rt_btn">右侧按钮</a>
        </div>
        <table class="table">
            <tr>
                <th>用户昵称</th>
                <th>性别</th>
                <th>城市</th>
                <th>省份</th>
                <th>国家</th>
                <th>关注时间</th>
                <th>用户头像</th>
                <th>用户状态</th>
                <th>标签</th>
                <th>是否拉黑</th>
                <th>备注</th>
                <th>操作</th>
            </tr>
            @foreach($fansInfo as $v)
                <tr  openid="{{$v->openid}}">
                    <td style="width:265px;"><div class="cut_title ellipsis">{{$v->nickname}}</div></td>
                    <td>@if($v->sex==2)女@else男@endif</td>
                    <td>{{$v->city}}</td>
                    <td>{{$v->province}}</td>
                    <td>{{$v->country}}</td>
                    <td>{{$v->subscribe_time}}</td>
                    <td><img src="{{$v->headimgurl}}" width="100px"></td>
                    <td>@if($v->status==0)未关注 @else 已关注 @endif</td>
                    <td>
                        @foreach($v->tags as $a)
                            <p>{{$a->name}}</p>
                        @endforeach
                    </td>
                    <td>@if($v->is_black==1)已拉黑 @else 未拉黑 @endif</td>
                    <td>
                        <input type="text" name="remark" value="{{$v->remark}}">
                    </td>
                    <td align="center">
                        @if($v->is_black==0)
                        <a href="{{url("/black/".$v->openid)}}">拉黑</a>
                        @else
                            <a href="{{url("/reblack/".$v->openid)}}">取消拉黑</a>
                            @endif
                            <a href="{{url("/user/tag/".$v->openid)}}">用户标签</a>
                    </td>
                </tr>
            @endforeach
        </table>
        <aside class="paging">
            {{$fansInfo->links()}}}
        </aside>
    </section>
    <!--tabStyle-->
    <script>
        $(document).ready(function(){
            //tab
            $(".admin_tab li a").click(function(){
                var liindex = $(".admin_tab li a").index(this);
                $(this).addClass("active").parent().siblings().find("a").removeClass("active");
                $(".admin_tab_cont").eq(liindex).fadeIn(150).siblings(".admin_tab_cont").hide();
            });
        });
    </script>
</div>
@endsection
@section("js")
    <script>
        //页面加载事件
        $(function(){
            //给input绑定失去焦点事件
            $("input[name='remark']").blur(function(){
                //获取文本输入框的默认值
                $remark = $(this).val();
                //获取openid
                $openid = $(this).parents("tr").attr("openid");
                //发送ajax请求
                $.ajax({
                    url:"{{url("/remark")}}",
                    data:{remark:$remark,openid:$openid},
                    dataType:"json",
                    type:"post",
                    success:function(res){
                       if(res["error_num"]==0){
                           alert(res["msg"]);
                       }else{
                           alert(res["msg"]);
                       }
                    }
                })
            })
        })
    </script>
@endsection