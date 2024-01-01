                <div class="container">
                    <div class="mt-5 col-4">
                        @if (session()->has('message'))
                            <div class="alert alert-success shadow">
                                {{ session('message') }}
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        @if (session()->has('fail'))
                            <span class="alert alert-danger p-3 mt-5">
                                {{ session('fail') }}
                            </span>
                        @endif
                    </div>
                </div>
