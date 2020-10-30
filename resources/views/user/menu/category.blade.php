<h2>Category</h2>
<div class="panel-group category-products" id="accordian"><!--category-productsr-->
    @foreach ($category as $ct)
    @if (!$ct->children->isEMPTY())
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordian" href="#{{ str_replace(' ', '', $ct->category_name) }}">
                    <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                    {{ $ct->category_name }}
                </a>
            </h4>
        </div>
        <div id="{{ str_replace(' ', '', $ct->category_name) }}" class="panel-collapse collapse">
            <div class="panel-body">
                <ul>
                    @foreach ($ct->children as $ct1)
                        <li><a href="{{ route('categorystore-view', str_replace(' ', '_', $ct1->category_name)) }}">{{ $ct1->category_name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @else   
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title"><a href="{{ route('categorystore-view', str_replace(' ', '_', $ct->category_name)) }}">{{ $ct->category_name }}</a></h4>
        </div>
    </div>
    @endif        
    @endforeach
</div><!--/category-products-->