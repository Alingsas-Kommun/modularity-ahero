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
            @if ((isset($quickLinks) && is_array($quickLinks) && !empty($quickLinks)) || (isset($rekAiEnabled) && $rekAiEnabled))
                <div class="a-hero__col__buttons">
                    @if (isset($quickLinks) && is_array($quickLinks) && !empty($quickLinks))
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
                    @endif
                    @if (isset($rekAiEnabled) && $rekAiEnabled && !empty($rekAiContainerId) && !empty($numberOfRecommendations))
                        <div id="{{ $rekAiContainerId }}" class="a-hero__rek-buttons">
                            @for ($i = 0; $i < $numberOfRecommendations; $i++)
                                <span class="rek-ai-preload-remove c-button c-button--md c-button--primary c-button--filled u-margin--0" aria-hidden="true">{{ __('Laddar…', 'modularity-alingsashero') }}</span>
                            @endfor
                        </div>
                        <script>
                        window.addEventListener("rekai.load", function() {
                            function renderHtml(data) {
                                var target = document.getElementById("{{ $rekAiContainerId }}");
                                if (!target) return;
                                var preloaderItems = target.querySelectorAll(".rek-ai-preload-remove");
                                if (preloaderItems) preloaderItems.forEach(function(item) { item.remove(); });
                                (data.predictions || []).forEach(function(p) {
                                    var a = document.createElement("a");
                                    a.href = p.url || "#";
                                    a.textContent = p.title || "";
                                    a.className = "c-button c-button--md c-button--primary c-button--filled u-margin--0";
                                    target.appendChild(a);
                                });
                                window.__rekai.checkAndAddEventsToDOM("#{{ $rekAiContainerId }}");
                            }
                            window.__rekai.predict({
                                overwrite: { addcontent: true, nrofhits: {{ $numberOfRecommendations }} }
                            }, renderHtml);
                        });
                        </script>
                    @endif
                </div>
            @endif
        </div>
        @if (isset($aHeroImage['sizes']['large']))
            <div style="background-image: url({{ $aHeroImage['sizes']['large'] }})" class="a-hero__col">
            </div>
        @endif

    </div>
