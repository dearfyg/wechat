@extends("layout.layout")
@section("content")
    <center><font color="red" size="2">{{session("msg")}}</font></center>
    <section>
        <h2><strong style="color:grey;">标签修改</strong></h2>
        <form action="{{url("/tag/update/".$tag->id)}}" method="post">
            <ul class="ulColumn2">
                <li>
                    <span class="item_name" style="width:120px;">标签名称：</span>
                    <input type="text" class="textbox textbox_295" value="{{$tag->name}}" name="name" placeholder="标签名称..."/>
                </li>
                <li>
                    <span class="item_name" style="width:120px;"></span>
                    <input type="submit" class="link_btn"/>
                </li>
            </ul>
        </form>
    </section>
@endsection
