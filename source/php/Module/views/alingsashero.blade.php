    <div lang="{{ $lang }}" class="a-hero">
        <div class="a-hero__col">
            @typography([
                'element' => 'h1',
                'variant' => 'h1',
                'classList' => ['page-header__title']
            ])
                {{ $customBlockTitle }}
            @endtypography
            @form([
            'method' => 'POST',
            'action' => home_url('/'),
            'classList' => ['u-width--100', 'a-hero__search-form']
            ])
            @group(['direction' => 'horizontal', 'classList' => ['u-width--100']])
                @field([
                    'id' => 'a-hero__search-form--field',
                    'type' => 'search',
                    'name' => 's',
                    'required' => true,
                    'placeholder' => $aHeroSearchPlaceholder,
                    'classList' => ['u-flex-grow--1'],
                    'size' => 'md',
                    'icon' => ['icon' => 'search']
                ])
                @endfield
            @endgroup
            @endform
            @if (isset($quickLinks) && is_array($quickLinks) && !empty($quickLinks))
                <div class="a-hero__col__buttons">
                    @foreach ($quickLinks as $quickLink)
                        @if (isset($quickLink['link']))
                            @button([
                                'text' => $quickLink['link']['title'] ?? '',
                                'href' => $quickLink['link']['url'] ?? '',
                                'target' => $quickLink['link']['target'] ?? '',
                                'size' => 'md',
                                'color' => $quickLink['color'],
                                'style' => $quickLink['style'],
                                'reversePositions' => true,
                                'classList' => ['u-margin--0'],
                            ])
                            @endbutton
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
        @if (isset($aHeroImage['sizes']['large']))
            <div style="background-image: url({{ $aHeroImage['sizes']['large'] }})" class="a-hero__col">
            </div>
        @endif

    </div>
