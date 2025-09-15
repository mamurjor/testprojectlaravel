<div id="testiCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @forelse($testimonials as $idx => $t)
            <div class="carousel-item {{ $idx === 0 ? 'active' : '' }}">
                <div class="testi-card mx-auto" style="max-width:760px;">
                    <div class="d-flex align-items-center gap-2 mb-2 stars">
                        @for ($i = 1; $i <= 5; $i++)
                            <i
                                class="bi {{ $i <= $t->rating ? 'bi-star-fill text-warning' : 'bi-star text-muted' }}"></i>
                        @endfor
                    </div>
                    <p class="mb-3">“{{ $t->quote }}”</p>
                    <div class="d-flex align-items-center gap-3">
                        @if ($t->avatar_src)
                            <img src="{{ asset('uploads/avatar' . $t->avatar_src) }}" class="rounded-circle"
                                width="44" height="44" alt="{{ $t->name }}">
                        @else
                            <div class="rounded-circle bg-light d-inline-block" style="width:44px;height:44px;"></div>
                        @endif
                        <div>
                            <strong>{{ $t->name }}</strong>
                            @if ($t->role)
                                <div class="small text-secondary">{{ $t->role }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="carousel-item active">
                <div class="testi-card mx-auto text-center py-4" style="max-width:760px;">
                    <p class="text-muted mb-0">No testimonials yet.</p>
                </div>
            </div>
        @endforelse
    </div>

    @if ($testimonials->count() > 1)
        <button class="carousel-control-prev" type="button" data-bs-target="#testiCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#testiCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Next</span>
        </button>
    @endif
</div>
