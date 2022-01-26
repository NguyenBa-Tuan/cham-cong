@push('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/atomic.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/icofont.min.css') }}">
    <style>
        body,
        .tk-content {
            min-width: 930px;
        }

        .main-sidebar {
            min-height: 100%;
        }

        .tk-px-30 {
            text-align: center;
            padding: 0;
        }

        .sub-content {
            display: inline-block;
            text-align: left;
        }

        .pagination-content {
            width: 900px;
            position: relative;
        }

        .download {
            position: absolute;
            right: 0;
            font-size: 20px;
            color: red;
        }

        .download:hover {
            color: #f28484;
        }

        .pagination-content nav {
            display: inline;
        }

        .pagination {
            display: inline-flex;

        }

        canvas {
            box-shadow: 0 0 6px #bbbec0;
        }

        @media only screen and (max-width: 1250px) {

            .tk-px-30,
            .tk-content {
                padding-left: 0;
                padding-right: 0;
            }
        }

        .tk-pt-41 {
            padding: 0 !important;
        }

        .tab-pane {
            min-height: 80vh;
        }

    </style>
@endpush
@if ($urlCompany)
    <div class="tk-pt-41">
        <div class="tk-px-30">
            <div class="tk-content">
                <div class="sub-content">
                    <div class="pagination-content" style="">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous" id="prev">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next" id="next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        &nbsp; &nbsp;
                        <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
                        <a href="{{ $urlCompany }}" title="Chi tiết & Tải xuống" target="_bank"
                            class="download"><i class="icofont-file-pdf"></i></a>
                    </div>

                    <canvas id="the-canvas" width=getWidth() height="8"></canvas>
                </div>

            </div>
        </div>
    </div>
@else
    <code style="padding-left: 30px">Chưa có file nội quy</code>
@endif
@push('scripts')
    <script src="//mozilla.github.io/pdf.js/build/pdf.js">
    </script>
    <script>
        // If absolute URL from the remote server is provided, configure the CORS
        // header on that server.
        var url = '{{ asset($urlCompany) }}';

        // Loaded via <script> tag, create shortcut to access PDF.js exports.
        var pdfjsLib = window['pdfjs-dist/build/pdf'];

        // The workerSrc property shall be specified.
        pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

        var pdfDoc = null,
            pageNum = 1,
            pageRendering = false,
            pageNumPending = null,
            scale = 0.8,
            canvas = document.getElementById('the-canvas'),
            ctx = canvas.getContext('2d');

        /**
         * Get page info from document, resize canvas accordingly, and render page.
         * @param num Page number.
         */
        function renderPage(num) {
            pageRendering = true;
            // Using promise to fetch the page
            pdfDoc.getPage(num).then(function(page) {
                canvas.width = 900;
                let scale = (canvas.width / page.view[2]);
                let viewport = page.getViewport({
                    scale: scale
                });
                canvas.height = page.view[3] * scale;

                // Render PDF page into canvas context
                var renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };
                var renderTask = page.render(renderContext);

                // Wait for rendering to finish
                renderTask.promise.then(function() {
                    pageRendering = false;
                    if (pageNumPending !== null) {
                        // New page rendering is pending
                        renderPage(pageNumPending);
                        pageNumPending = null;
                    }
                });
            });

            // Update page counters
            document.getElementById('page_num').textContent = num;
        }

        /**
         * If another page rendering in progress, waits until the rendering is
         * finised. Otherwise, executes rendering immediately.
         */
        function queueRenderPage(num) {
            if (pageRendering) {
                pageNumPending = num;
            } else {
                renderPage(num);
            }
        }

        /**
         * Displays previous page.
         */
        function onPrevPage() {
            if (pageNum <= 1) {
                return;
            }
            pageNum--;
            queueRenderPage(pageNum);
        }
        document.getElementById('prev').addEventListener('click', onPrevPage);

        /**
         * Displays next page.
         */
        function onNextPage() {
            if (pageNum >= pdfDoc.numPages) {
                return;
            }
            pageNum++;
            queueRenderPage(pageNum);
        }
        document.getElementById('next').addEventListener('click', onNextPage);

        /**
         * Asynchronously downloads PDF.
         */
        pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
            pdfDoc = pdfDoc_;
            document.getElementById('page_count').textContent = pdfDoc.numPages;

            // Initial/first page rendering
            renderPage(pageNum);
        });
    </script>
@endpush
