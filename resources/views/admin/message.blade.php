                <div class="mb-3">
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
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
