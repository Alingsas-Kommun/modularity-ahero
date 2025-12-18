    <div class="a-hero">
        <div class="a-hero__col">
            @typography([
                'element' => 'h1',
                'variant' => 'h1',
                'classList' => ['page-header__title']
            ])
                {{ $aHeroText ?? '' }}
            @endtypography
            @if (isset($showSearch) && $showSearch)
                @form([
                'method' => 'GET',
                'action' => home_url('/'),
                'classList' => ['u-width--100', 'a-hero__search-form']
                ])
                @group(['direction' => 'horizontal', 'classList' => ['u-width--100']])
                    @field([
                        'type' => 'text',
                        'id' => 'a-hero__search-form--field',
                        'name' => 's',
                        'required' => false,
                        'radius' => 'sm',
                        'label' => $aHeroSearchPlaceholder,
                        'hideLabel' => true,
                        'icon' => ['icon' => ''],
                        'classList' => ['u-flex-grow--1', 'u-box-shadow--1']
                    ])
                    @endfield

                    @button([
                        'classList' => [
                            'a-hero__search-form__submit-icon',
                            'c-button--no-disabled-color',
                        ],
                        'style' => 'primary',
                        'type' => 'submit',
                        'icon' => 'search',
                        'reversePositions' => true,
                        'text' => $search,
                        'attributeList' => [
                            'aria-label' => $search,
                        ],
                    ])
                    @endbutton
                @endgroup
            @endform
            @endif
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
