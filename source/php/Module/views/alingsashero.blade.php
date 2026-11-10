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
                @group(['direction' => 'horizontal', 'classList' => ['u-width--100', 'c-group--skip-child-normalization']])
                    @field([
                        'type' => 'text',
                        'id' => \AlingsasHero\Module\alingsashero::nextSearchFieldId(),
                        'name' => 's',
                        'required' => false,
                        'radius' => 'sm',
                        'label' => $aHeroSearchPlaceholder,
                        'hideLabel' => true,
                        'icon' => ['icon' => ''],
                        'classList' => ['u-flex-grow--1']
                    ])
                    @endfield

                    @button([
                        'classList' => [
                            'a-hero__search-form__submit-icon',
                            'c-button--no-disabled-color',
                        ],
                        'color' => 'primary',
                        'style' => 'filled',
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
                    @if (isset($rekAiEnabled) && $rekAiEnabled && !empty($rekAiContainerId) && !empty($numberOfRecommendations))
                        <div id="{{ $rekAiContainerId }}" class="a-hero__rek-buttons" hidden>
                            @for ($i = 0; $i < $numberOfRecommendations; $i++)
                                <span
                                    class="rek-ai-preload-remove c-button c-button--md c-button--primary c-button--filled u-margin--0"
                                    aria-hidden="true">{{ __('Laddar…', 'modularity-alingsashero') }}</span>
                            @endfor
                        </div>
                        <script>
                            (function() {
                                // Bind to the container right before this script, not by id: block
                                // output is fragment-cached per block data, so two identical hero
                                // blocks can be served with the same container id.
                                var script = document.currentScript;
                                var target = script && script.previousElementSibling;
                                if (!target || !target.classList.contains("a-hero__rek-buttons")) {
                                    target = document.getElementById("{{ $rekAiContainerId }}");
                                }
                                if (!target) return;
                                if (document.querySelectorAll('[id="' + target.id + '"]').length > 1) {
                                    target.id = target.id + "-" + Math.random().toString(36).slice(2, 10);
                                }

                                function hasAnalyticsConsent(detail) {
                                    var categories = (detail && detail.cookie && detail.cookie.categories) ||
                                        (detail && detail.changedCategories) || [];
                                    return categories.indexOf("analytics") !== -1;
                                }

                                function handleConsent(event) {
                                    target.hidden = !hasAnalyticsConsent(event.detail);
                                }

                                window.addEventListener("pressidium-cookie-consent-accepted", handleConsent);
                                window.addEventListener("pressidium-cookie-consent-changed", handleConsent);

                                window.addEventListener("rekai.load", function() {
                                    function renderHtml(data) {
                                        target.querySelectorAll(".rek-ai-preload-remove").forEach(function(item) {
                                            item.remove();
                                        });
                                        (data.predictions || []).forEach(function(p) {
                                            var a = document.createElement("a");
                                            a.href = p.url || "#";
                                            a.textContent = p.title || "";
                                            a.className =
                                                "c-button c-button--md c-button--primary c-button--filled c-button--pill u-margin--0";
                                            target.appendChild(a);
                                        });
                                        window.__rekai.checkAndAddEventsToDOM("#" + target.id);
                                    }
                                    var rekaiOptions = {
                                        overwrite: {
                                            addcontent: true,
                                            nrofhits: {{ (int) $numberOfRecommendations }}
                                        }
                                    };
                                    @if (!empty($rekAiExcludetree))
                                        rekaiOptions.overwrite.excludetree = "{{ $rekAiExcludetree }}";
                                    @endif
                                    window.__rekai.predict(rekaiOptions, renderHtml);
                                });
                            })();
                        </script>
                    @endif
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
                                    'shape' => 'pill',
                                    'reversePositions' => true,
                                    'classList' => ['u-margin--0'],
                                ])
                                @endbutton
                            @endif
                        @endforeach
                    @endif
                </div>
            @endif
        </div>
        @if (isset($aHeroImage['sizes']['large']))
            <div style="background-image: url({{ $aHeroImage['sizes']['large'] }})" class="a-hero__col">
            </div>
        @endif

    </div>
