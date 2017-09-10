<style type="text/css">
    .reactions {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        background: #FFFFFF;
        padding: 5px;
        border-radius: 100px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
    }
    .reactions .item {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: start;
        -ms-flex-align: start;
        align-items: flex-start;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        background-image: url(https://z-1-static.xx.fbcdn.net/rsrc.php/v2/yh/r/sqhTN9lgaYm.png);
        background-repeat: no-repeat;
        cursor: pointer;
        -webkit-transform: scale(0.8) translate(0, 0);
        transform: scale(0.8) translate(0, 0);
        -webkit-transition: -webkit-transform 200ms ease;
        transition: -webkit-transform 200ms ease;
        transition: transform 200ms ease;
        transition: transform 200ms ease, -webkit-transform 200ms ease;
    }
    .reactions .item:before {
        content: attr(data-text);
        display: none;
        color: #FFFFFF;
        font-size: 0.8em;
        border-radius: 100px;
        padding: 3px 10px;
        margin-top: -25px;
        background: rgba(0, 0, 0, 0.8);
    }
    .reactions .item:hover {
        -webkit-transform: scale(1) translate(0, -6px);
        transform: scale(1) translate(0, -6px);
    }
    .reactions .item:hover:before {
        display: block;
    }
    .reactions .item.item-like {
        background-position: 0 -144px;
    }
    .reactions .item.item-love {
        background-position: 0 -192px;
    }
    .reactions .item.item-haha {
        background-position: 0 -96px;
    }
    .reactions .item.item-wow {
        background-position: 0 -288px;
    }
    .reactions .item.item-sad {
        background-position: 0 -240px;
    }
    .reactions .item.item-angry {
        background-position: 0 0;
    }
</style>


<ul class="reactions">
    @foreach($resource->reactions()->get() as $reaction)
        <li class="item item-{{$reaction->context}}" data-text="{{$reaction->context}}"></li>
    @endforeach
</ul>
