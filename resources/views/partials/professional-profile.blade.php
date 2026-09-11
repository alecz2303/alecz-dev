@php($professional = config('professional_profile.'.app()->getLocale(), config('professional_profile.es')))
@php($cvPath = trim((string) config('profile.cv.path', ''), '/'))
@php($cvAvailable = $cvPath !== '' && is_file(public_path($cvPath)))

<section id="perfil" class="experience-section" aria-labelledby="professional-profile-title" data-reveal>
    <div class="section-heading">
        <div>
            <p class="section-path">~/profile</p>
            <span class="stack-label">{{ $professional['eyebrow'] }}</span>
            <h2 id="professional-profile-title">{{ $professional['title'] }}</h2>
        </div>
        <p class="section-intro">{{ $professional['intro'] }}</p>
    </div>

    <div class="experience-list">
        @foreach ($professional['focus'] as $item)
            <article>
                <span>{{ $item['label'] }}</span>
                <h3>{{ $item['title'] }}</h3>
                <p>{{ $item['text'] }}</p>
            </article>
        @endforeach
    </div>

    <div class="services-cta">
        <div>
            <h3>{{ $professional['evidence_title'] }}</h3>
            <p>{{ implode(' · ', $professional['evidence']) }}</p>
            @unless ($cvAvailable)<small>{{ $professional['cv_note'] }}</small>@endunless
        </div>
        @if ($cvAvailable)
            <a class="button button-secondary" href="{{ asset($cvPath) }}" download>{{ $professional['cv'] }} <span aria-hidden="true">↓</span></a>
        @endif
    </div>
</section>
