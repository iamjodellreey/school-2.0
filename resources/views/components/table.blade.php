@props(['title', 'thead', 'tbody'])

<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">{{ $title }}</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            {{ $thead }}
                        </thead>
                        <tbody>
                            {{ $tbody }}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
