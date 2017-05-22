<div class="row">
    <div class="col-sm-3">
        <a class="btn btn-default" href="/movies/create" role="button">Add a Movie</a>
    </div>
    <div class="col-sm-6 text-center pager" id="pager_top">
        <!-- targeted by the "pager.container" option -->
        <img src="/lib/tablesorter/css/images/first.png" class="first" alt="First" title="First page" />
        <img src="/lib/tablesorter/css/images/prev.png" class="prev" alt="Prev" title="Previous page" />
        <span class="pagedisplay"></span>
        <img src="/lib/tablesorter/css/images//next.png" class="next" alt="Next" title="Next page" />
        <img src="/lib/tablesorter/css/images//last.png" class="last" alt="Last" title= "Last page" />
    </div>
    <div class="col-sm-3 text-right">
        <!-- targeted by the "filter_reset" option -->
        <button type="button" class="reset btn btn-default">Reset Search</button>
    </div>
</div>

<table class="table table-striped tablesorter-blue" id="movie-list">
    <thead>
    <tr>
        <th>Title</th>
        <th class="filter-select">Genre</th>
        <th>Actors</th>
        <th class="filter-select">Rating</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($movies as $movie)
        <tr>
            <td><a href="{{ $movie->path() }}">{{ $movie->title }}</a></td>
            <td>{{ $movie->genre }}</td>
            <td>{{ $movie->actors }}</td>
            <td data-sort-value="{{ $movie->rating }}">
                @if ($movie->rating)
                    <span class="star-rating rating-{{ intval($movie->rating * 10) }}"></span>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>


<div class="row">
    <div class="col-sm-12 text-center pager" id="pager_bottom"></div>
</div>


@section('scripts')
    @parent

    <script src="{{ asset('lib/tablesorter/js/jquery.tablesorter.min.js') }}"></script>
    <script src="{{ asset('lib/tablesorter/js/widgets/widget-storage.min.js') }}"></script>
    <script src="{{ asset('lib/tablesorter/js/widgets/widget-filter.min.js') }}"></script>
    <script src="{{ asset('lib/tablesorter/js/widgets/widget-pager.min.js') }}"></script>
    <script src="{{ asset('lib/tablesorter/js/extras/jquery.tablesorter.pager.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Copy the pagination controls at the top of the table to the bottom
            $('#pager_bottom').html($('#pager_top').html());

            $("#movie-list")
                    .tablesorter({
                        // Default sort order: [col_num, direction]
                        // Sort by first column in ascending order by default
                        sortList: [[0, 0]],
                        // If the cell has a data-sort-value attribute use that as the sort value
                        // else use the cell value
                        textExtraction: function (node, table, cellIndex) {
                            n = $(node);
                            return n.attr('data-sort-value') || n.text();
                        },
                        // How to deal with sorting empty table cells
                        emptyTo: 'emptyMin',
                        widgets: ['zebra', 'filter'],
                        widgetOptions: {
                            // If true, a filter will be added to the top of each table column
                            filter_columnFilters: true,
                            // Default placeholder text
                            filter_placeholder: {search: 'Search...'},
                            // jQuery selector string of an element used to reset the filters
                            filter_reset: '.reset',
                            // Add filter functions to columns.
                            // Each option has an associated function that returns a boolean.
                            // Function variables:
                            // e = exact text from cell
                            // n = normalized value returned by the column parser
                            // f = search filter input value
                            // i = column index
                            filter_functions: {
                                // Create a drop down for the ratings column
                                3: {
                                    "2+ stars": function (e, n, f, i, $r, c, data) {
                                        return n >= 2.0;
                                    },
                                    "3+ stars": function (e, n, f, i, $r, c, data) {
                                        return n >= 3.0;
                                    },
                                    "4+ stars": function (e, n, f, i, $r, c, data) {
                                        return n >= 4.0;
                                    },
                                    "5 stars": function (e, n, f, i, $r, c, data) {
                                        return n >= 5.0;
                                    }
                                }
                            }
                        }
                    })
                    .tablesorterPager({
                        // Pagination markup containers
                        container: '.pager',
                        // Output display
                        output: '{startRow} - {endRow} of {filteredRows}',
                        // Items per page
                        size: 25,
                        // Save the current pager page size and number?
                        savePages: false
                    });
        });
    </script>
@stop

@section('styles')
    @parent

    <link rel="stylesheet" href="{{ asset('lib/tablesorter/css/theme.blue.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/tablesorter/css/jquery.tablesorter.pager.min.css') }}">
@stop