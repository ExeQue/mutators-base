var Doctum = {
    treeJson: {"tree":{"l":0,"n":"","p":"","c":[{"l":1,"n":"ExeQue","p":"ExeQue","c":[{"l":2,"n":"Remix","p":"ExeQue/Remix","c":[{"l":3,"n":"Compare","p":"ExeQue/Remix/Compare","c":[{"l":4,"n":"Array","p":"ExeQue/Remix/Compare/Array","c":[{"l":5,"n":"ArrayComparator","p":"ExeQue/Remix/Compare/Array/ArrayComparator"},{"l":5,"n":"IsEmpty","p":"ExeQue/Remix/Compare/Array/IsEmpty"},{"l":5,"n":"IsList","p":"ExeQue/Remix/Compare/Array/IsList"},{"l":5,"n":"IsMap","p":"ExeQue/Remix/Compare/Array/IsMap"},{"l":5,"n":"KeyExists","p":"ExeQue/Remix/Compare/Array/KeyExists"}]},{"l":4,"n":"Countable","p":"ExeQue/Remix/Compare/Countable","c":[{"l":5,"n":"CountBetween","p":"ExeQue/Remix/Compare/Countable/CountBetween"},{"l":5,"n":"CountEqual","p":"ExeQue/Remix/Compare/Countable/CountEqual"},{"l":5,"n":"CountMax","p":"ExeQue/Remix/Compare/Countable/CountMax"},{"l":5,"n":"CountMin","p":"ExeQue/Remix/Compare/Countable/CountMin"},{"l":5,"n":"CountableComparator","p":"ExeQue/Remix/Compare/Countable/CountableComparator"}]},{"l":4,"n":"Format","p":"ExeQue/Remix/Compare/Format","c":[{"l":5,"n":"IsDateTimeFormat","p":"ExeQue/Remix/Compare/Format/IsDateTimeFormat"},{"l":5,"n":"IsHexadecimal","p":"ExeQue/Remix/Compare/Format/IsHexadecimal"},{"l":5,"n":"IsJson","p":"ExeQue/Remix/Compare/Format/IsJson"}]},{"l":4,"n":"Logical","p":"ExeQue/Remix/Compare/Logical","c":[{"l":5,"n":"All","p":"ExeQue/Remix/Compare/Logical/All"},{"l":5,"n":"Any","p":"ExeQue/Remix/Compare/Logical/Any"},{"l":5,"n":"Not","p":"ExeQue/Remix/Compare/Logical/Not"},{"l":5,"n":"One","p":"ExeQue/Remix/Compare/Logical/One"}]},{"l":4,"n":"Number","p":"ExeQue/Remix/Compare/Number","c":[{"l":5,"n":"IsEven","p":"ExeQue/Remix/Compare/Number/IsEven"},{"l":5,"n":"IsOdd","p":"ExeQue/Remix/Compare/Number/IsOdd"},{"l":5,"n":"Max","p":"ExeQue/Remix/Compare/Number/Max"},{"l":5,"n":"Min","p":"ExeQue/Remix/Compare/Number/Min"},{"l":5,"n":"NumberComparator","p":"ExeQue/Remix/Compare/Number/NumberComparator"}]},{"l":4,"n":"String","p":"ExeQue/Remix/Compare/String","c":[{"l":5,"n":"Contains","p":"ExeQue/Remix/Compare/String/Contains"},{"l":5,"n":"ContainsAll","p":"ExeQue/Remix/Compare/String/ContainsAll"},{"l":5,"n":"ContainsAny","p":"ExeQue/Remix/Compare/String/ContainsAny"},{"l":5,"n":"LengthBetween","p":"ExeQue/Remix/Compare/String/LengthBetween"},{"l":5,"n":"LengthComparator","p":"ExeQue/Remix/Compare/String/LengthComparator"},{"l":5,"n":"LengthEqual","p":"ExeQue/Remix/Compare/String/LengthEqual"},{"l":5,"n":"LengthMax","p":"ExeQue/Remix/Compare/String/LengthMax"},{"l":5,"n":"LengthMin","p":"ExeQue/Remix/Compare/String/LengthMin"},{"l":5,"n":"Matches","p":"ExeQue/Remix/Compare/String/Matches"},{"l":5,"n":"StringComparator","p":"ExeQue/Remix/Compare/String/StringComparator"}]},{"l":4,"n":"Comparator","p":"ExeQue/Remix/Compare/Comparator"},{"l":4,"n":"ComparatorAlias","p":"ExeQue/Remix/Compare/ComparatorAlias"},{"l":4,"n":"ComparatorInterface","p":"ExeQue/Remix/Compare/ComparatorInterface"},{"l":4,"n":"ComparesUsing","p":"ExeQue/Remix/Compare/ComparesUsing"},{"l":4,"n":"Equal","p":"ExeQue/Remix/Compare/Equal"},{"l":4,"n":"IsType","p":"ExeQue/Remix/Compare/IsType"},{"l":4,"n":"Same","p":"ExeQue/Remix/Compare/Same"}]},{"l":3,"n":"Concerns","p":"ExeQue/Remix/Concerns","c":[{"l":4,"n":"Definitions","p":"ExeQue/Remix/Concerns/Definitions","c":[{"l":5,"n":"TakesOnlyStringCasing","p":"ExeQue/Remix/Concerns/Definitions/TakesOnlyStringCasing"},{"l":5,"n":"UsesEncoding","p":"ExeQue/Remix/Concerns/Definitions/UsesEncoding"}]},{"l":4,"n":"Sanitization","p":"ExeQue/Remix/Concerns/Sanitization","c":[{"l":5,"n":"SanitizesHexStrings","p":"ExeQue/Remix/Concerns/Sanitization/SanitizesHexStrings"}]},{"l":4,"n":"Validation","p":"ExeQue/Remix/Concerns/Validation","c":[{"l":5,"n":"ValidatesEncoding","p":"ExeQue/Remix/Concerns/Validation/ValidatesEncoding"}]},{"l":4,"n":"HasMultipleComparators","p":"ExeQue/Remix/Concerns/HasMultipleComparators"},{"l":4,"n":"Makes","p":"ExeQue/Remix/Concerns/Makes"},{"l":4,"n":"ResolvesComparators","p":"ExeQue/Remix/Concerns/ResolvesComparators"},{"l":4,"n":"ResolvesMutators","p":"ExeQue/Remix/Concerns/ResolvesMutators"}]},{"l":3,"n":"Exceptions","p":"ExeQue/Remix/Exceptions","c":[{"l":4,"n":"InvalidArgumentException","p":"ExeQue/Remix/Exceptions/InvalidArgumentException"},{"l":4,"n":"InvalidComparatorException","p":"ExeQue/Remix/Exceptions/InvalidComparatorException"},{"l":4,"n":"InvalidMutatorException","p":"ExeQue/Remix/Exceptions/InvalidMutatorException"},{"l":4,"n":"JsonException","p":"ExeQue/Remix/Exceptions/JsonException"},{"l":4,"n":"MissingTagException","p":"ExeQue/Remix/Exceptions/MissingTagException"},{"l":4,"n":"RemixException","p":"ExeQue/Remix/Exceptions/RemixException"},{"l":4,"n":"SerializationException","p":"ExeQue/Remix/Exceptions/SerializationException"},{"l":4,"n":"SerializeException","p":"ExeQue/Remix/Exceptions/SerializeException"},{"l":4,"n":"UnreachableException","p":"ExeQue/Remix/Exceptions/UnreachableException"}]},{"l":3,"n":"Helpers","p":"ExeQue/Remix/Helpers","c":[{"l":4,"n":"Uses","p":"ExeQue/Remix/Helpers/Uses"}]},{"l":3,"n":"Mutate","p":"ExeQue/Remix/Mutate","c":[{"l":4,"n":"Array","p":"ExeQue/Remix/Mutate/Array","c":[{"l":5,"n":"ArrayMutator","p":"ExeQue/Remix/Mutate/Array/ArrayMutator"},{"l":5,"n":"At","p":"ExeQue/Remix/Mutate/Array/At"},{"l":5,"n":"Each","p":"ExeQue/Remix/Mutate/Array/Each"},{"l":5,"n":"Except","p":"ExeQue/Remix/Mutate/Array/Except"},{"l":5,"n":"First","p":"ExeQue/Remix/Mutate/Array/First"},{"l":5,"n":"Flip","p":"ExeQue/Remix/Mutate/Array/Flip"},{"l":5,"n":"KeyCase","p":"ExeQue/Remix/Mutate/Array/KeyCase"},{"l":5,"n":"Keys","p":"ExeQue/Remix/Mutate/Array/Keys"},{"l":5,"n":"Last","p":"ExeQue/Remix/Mutate/Array/Last"},{"l":5,"n":"Map","p":"ExeQue/Remix/Mutate/Array/Map"},{"l":5,"n":"MapKeys","p":"ExeQue/Remix/Mutate/Array/MapKeys"},{"l":5,"n":"Only","p":"ExeQue/Remix/Mutate/Array/Only"},{"l":5,"n":"Reverse","p":"ExeQue/Remix/Mutate/Array/Reverse"},{"l":5,"n":"Sort","p":"ExeQue/Remix/Mutate/Array/Sort"},{"l":5,"n":"SortKeys","p":"ExeQue/Remix/Mutate/Array/SortKeys"},{"l":5,"n":"Values","p":"ExeQue/Remix/Mutate/Array/Values"},{"l":5,"n":"Walk","p":"ExeQue/Remix/Mutate/Array/Walk"},{"l":5,"n":"WalkRecursive","p":"ExeQue/Remix/Mutate/Array/WalkRecursive"},{"l":5,"n":"Wrap","p":"ExeQue/Remix/Mutate/Array/Wrap"}]},{"l":4,"n":"Convert","p":"ExeQue/Remix/Mutate/Convert","c":[{"l":5,"n":"BinToHex","p":"ExeQue/Remix/Mutate/Convert/BinToHex"},{"l":5,"n":"HexToBin","p":"ExeQue/Remix/Mutate/Convert/HexToBin"},{"l":5,"n":"HexToInt","p":"ExeQue/Remix/Mutate/Convert/HexToInt"},{"l":5,"n":"IntToHex","p":"ExeQue/Remix/Mutate/Convert/IntToHex"},{"l":5,"n":"ToArray","p":"ExeQue/Remix/Mutate/Convert/ToArray"},{"l":5,"n":"ToBool","p":"ExeQue/Remix/Mutate/Convert/ToBool"},{"l":5,"n":"ToClass","p":"ExeQue/Remix/Mutate/Convert/ToClass"},{"l":5,"n":"ToFloat","p":"ExeQue/Remix/Mutate/Convert/ToFloat"},{"l":5,"n":"ToInt","p":"ExeQue/Remix/Mutate/Convert/ToInt"},{"l":5,"n":"ToObject","p":"ExeQue/Remix/Mutate/Convert/ToObject"},{"l":5,"n":"ToString","p":"ExeQue/Remix/Mutate/Convert/ToString"}]},{"l":4,"n":"Serialization","p":"ExeQue/Remix/Mutate/Serialization","c":[{"l":5,"n":"Base64Decode","p":"ExeQue/Remix/Mutate/Serialization/Base64Decode"},{"l":5,"n":"Base64Encode","p":"ExeQue/Remix/Mutate/Serialization/Base64Encode"},{"l":5,"n":"Deserialize","p":"ExeQue/Remix/Mutate/Serialization/Deserialize"},{"l":5,"n":"JsonDecode","p":"ExeQue/Remix/Mutate/Serialization/JsonDecode"},{"l":5,"n":"JsonEncode","p":"ExeQue/Remix/Mutate/Serialization/JsonEncode"},{"l":5,"n":"Serialize","p":"ExeQue/Remix/Mutate/Serialization/Serialize"}]},{"l":4,"n":"String","p":"ExeQue/Remix/Mutate/String","c":[{"l":5,"n":"After","p":"ExeQue/Remix/Mutate/String/After"},{"l":5,"n":"Append","p":"ExeQue/Remix/Mutate/String/Append"},{"l":5,"n":"Before","p":"ExeQue/Remix/Mutate/String/Before"},{"l":5,"n":"Casing","p":"ExeQue/Remix/Mutate/String/Casing"},{"l":5,"n":"Chunk","p":"ExeQue/Remix/Mutate/String/Chunk"},{"l":5,"n":"Explode","p":"ExeQue/Remix/Mutate/String/Explode"},{"l":5,"n":"Hash","p":"ExeQue/Remix/Mutate/String/Hash"},{"l":5,"n":"Hmac","p":"ExeQue/Remix/Mutate/String/Hmac"},{"l":5,"n":"Mask","p":"ExeQue/Remix/Mutate/String/Mask"},{"l":5,"n":"Pad","p":"ExeQue/Remix/Mutate/String/Pad"},{"l":5,"n":"PositionOf","p":"ExeQue/Remix/Mutate/String/PositionOf"},{"l":5,"n":"PositionOfLast","p":"ExeQue/Remix/Mutate/String/PositionOfLast"},{"l":5,"n":"Prepend","p":"ExeQue/Remix/Mutate/String/Prepend"},{"l":5,"n":"Remove","p":"ExeQue/Remix/Mutate/String/Remove"},{"l":5,"n":"Replace","p":"ExeQue/Remix/Mutate/String/Replace"},{"l":5,"n":"ReplaceFirst","p":"ExeQue/Remix/Mutate/String/ReplaceFirst"},{"l":5,"n":"ReplaceLast","p":"ExeQue/Remix/Mutate/String/ReplaceLast"},{"l":5,"n":"Reverse","p":"ExeQue/Remix/Mutate/String/Reverse"},{"l":5,"n":"StringMutator","p":"ExeQue/Remix/Mutate/String/StringMutator"},{"l":5,"n":"Substring","p":"ExeQue/Remix/Mutate/String/Substring"},{"l":5,"n":"Tags","p":"ExeQue/Remix/Mutate/String/Tags"},{"l":5,"n":"Trim","p":"ExeQue/Remix/Mutate/String/Trim"},{"l":5,"n":"Truncate","p":"ExeQue/Remix/Mutate/String/Truncate"},{"l":5,"n":"Ucfirst","p":"ExeQue/Remix/Mutate/String/Ucfirst"},{"l":5,"n":"Ucwords","p":"ExeQue/Remix/Mutate/String/Ucwords"},{"l":5,"n":"Wrap","p":"ExeQue/Remix/Mutate/String/Wrap"}]},{"l":4,"n":"CompoundMutator","p":"ExeQue/Remix/Mutate/CompoundMutator"},{"l":4,"n":"MutatesUsing","p":"ExeQue/Remix/Mutate/MutatesUsing"},{"l":4,"n":"Mutator","p":"ExeQue/Remix/Mutate/Mutator"},{"l":4,"n":"MutatorAlias","p":"ExeQue/Remix/Mutate/MutatorAlias"},{"l":4,"n":"MutatorInterface","p":"ExeQue/Remix/Mutate/MutatorInterface"},{"l":4,"n":"When","p":"ExeQue/Remix/Mutate/When"}]},{"l":3,"n":"Serialize","p":"ExeQue/Remix/Serialize","c":[{"l":4,"n":"Base64Serializer","p":"ExeQue/Remix/Serialize/Base64Serializer"},{"l":4,"n":"JsonSerializer","p":"ExeQue/Remix/Serialize/JsonSerializer"},{"l":4,"n":"Serializer","p":"ExeQue/Remix/Serialize/Serializer"},{"l":4,"n":"SerializerInterface","p":"ExeQue/Remix/Serialize/SerializerInterface"}]},{"l":3,"n":"Testing","p":"ExeQue/Remix/Testing","c":[{"l":4,"n":"Regexp","p":"ExeQue/Remix/Testing/Regexp"},{"l":4,"n":"Tester","p":"ExeQue/Remix/Testing/Tester"}]},{"l":3,"n":"Assert","p":"ExeQue/Remix/Assert"}]}]}]},"treeOpenLevel":2},
    /** @var boolean */
    treeLoaded: false,
    /** @var boolean */
    listenersRegistered: false,
    autoCompleteData: null,
    /** @var boolean */
    autoCompleteLoading: false,
    /** @var boolean */
    autoCompleteLoaded: false,
    /** @var string|null */
    rootPath: null,
    /** @var string|null */
    autoCompleteDataUrl: null,
    /** @var HTMLElement|null */
    doctumSearchAutoComplete: null,
    /** @var HTMLElement|null */
    doctumSearchAutoCompleteProgressBarContainer: null,
    /** @var HTMLElement|null */
    doctumSearchAutoCompleteProgressBar: null,
    /** @var number */
    doctumSearchAutoCompleteProgressBarPercent: 0,
    /** @var autoComplete|null */
    autoCompleteJS: null,
    querySearchSecurityRegex: /([^0-9a-zA-Z:\\\\_\s])/gi,
    buildTreeNode: function (treeNode, htmlNode, treeOpenLevel) {
        var ulNode = document.createElement('ul');
        for (var childKey in treeNode.c) {
            var child = treeNode.c[childKey];
            var liClass = document.createElement('li');
            var hasChildren = child.hasOwnProperty('c');
            var nodeSpecialName = (hasChildren ? 'namespace:' : 'class:') + child.p.replace(/\//g, '_');
            liClass.setAttribute('data-name', nodeSpecialName);

            // Create the node that will have the text
            var divHd = document.createElement('div');
            var levelCss = child.l - 1;
            divHd.className = hasChildren ? 'hd' : 'hd leaf';
            divHd.style.paddingLeft = (hasChildren ? (levelCss * 18) : (8 + (levelCss * 18))) + 'px';
            if (hasChildren) {
                if (child.l <= treeOpenLevel) {
                    liClass.className = 'opened';
                }
                var spanIcon = document.createElement('span');
                spanIcon.className = 'icon icon-play';
                divHd.appendChild(spanIcon);
            }
            var aLink = document.createElement('a');

            // Edit the HTML link to work correctly based on the current depth
            aLink.href = Doctum.rootPath + child.p + '.html';
            aLink.innerText = child.n;
            divHd.appendChild(aLink);
            liClass.appendChild(divHd);

            // It has children
            if (hasChildren) {
                var divBd = document.createElement('div');
                divBd.className = 'bd';
                Doctum.buildTreeNode(child, divBd, treeOpenLevel);
                liClass.appendChild(divBd);
            }
            ulNode.appendChild(liClass);
        }
        htmlNode.appendChild(ulNode);
    },
    initListeners: function () {
        if (Doctum.listenersRegistered) {
            // Quick exit, already registered
            return;
        }
                Doctum.listenersRegistered = true;
    },
    loadTree: function () {
        if (Doctum.treeLoaded) {
            // Quick exit, already registered
            return;
        }
        Doctum.rootPath = document.body.getAttribute('data-root-path');
        Doctum.buildTreeNode(Doctum.treeJson.tree, document.getElementById('api-tree'), Doctum.treeJson.treeOpenLevel);

        // Toggle left-nav divs on click
        $('#api-tree .hd span').on('click', function () {
            $(this).parent().parent().toggleClass('opened');
        });

        // Expand the parent namespaces of the current page.
        var expected = $('body').attr('data-name');

        if (expected) {
            // Open the currently selected node and its parents.
            var container = $('#api-tree');
            var node = $('#api-tree li[data-name="' + expected + '"]');
            // Node might not be found when simulating namespaces
            if (node.length > 0) {
                node.addClass('active').addClass('opened');
                node.parents('li').addClass('opened');
                var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
                // Position the item nearer to the top of the screen.
                scrollPos -= 200;
                container.scrollTop(scrollPos);
            }
        }
        Doctum.treeLoaded = true;
    },
    pagePartiallyLoaded: function (event) {
        Doctum.initListeners();
        Doctum.loadTree();
        Doctum.loadAutoComplete();
    },
    pageFullyLoaded: function (event) {
        // it may not have received DOMContentLoaded event
        Doctum.initListeners();
        Doctum.loadTree();
        Doctum.loadAutoComplete();
        // Fire the event in the search page too
        if (typeof DoctumSearch === 'object') {
            DoctumSearch.pageFullyLoaded();
        }
    },
    loadAutoComplete: function () {
        if (Doctum.autoCompleteLoaded) {
            // Quick exit, already loaded
            return;
        }
        Doctum.autoCompleteDataUrl = document.body.getAttribute('data-search-index-url');
        Doctum.doctumSearchAutoComplete = document.getElementById('doctum-search-auto-complete');
        Doctum.doctumSearchAutoCompleteProgressBarContainer = document.getElementById('search-progress-bar-container');
        Doctum.doctumSearchAutoCompleteProgressBar = document.getElementById('search-progress-bar');
        if (Doctum.doctumSearchAutoComplete !== null) {
            // Wait for it to be loaded
            Doctum.doctumSearchAutoComplete.addEventListener('init', function (_) {
                Doctum.autoCompleteLoaded = true;
                Doctum.doctumSearchAutoComplete.addEventListener('selection', function (event) {
                    // Go to selection page
                    window.location = Doctum.rootPath + event.detail.selection.value.p;
                });
                Doctum.doctumSearchAutoComplete.addEventListener('navigate', function (event) {
                    // Set selection in text box
                    if (typeof event.detail.selection.value === 'object') {
                        Doctum.doctumSearchAutoComplete.value = event.detail.selection.value.n;
                    }
                });
                Doctum.doctumSearchAutoComplete.addEventListener('results', function (event) {
                    Doctum.markProgressFinished();
                });
            });
        }
        // Check if the lib is loaded
        if (typeof autoComplete === 'function') {
            Doctum.bootAutoComplete();
        }
    },
    markInProgress: function () {
            Doctum.doctumSearchAutoCompleteProgressBarContainer.className = 'search-bar';
            Doctum.doctumSearchAutoCompleteProgressBar.className = 'progress-bar indeterminate';
            if (typeof DoctumSearch === 'object' && DoctumSearch.pageFullyLoaded) {
                DoctumSearch.doctumSearchPageAutoCompleteProgressBarContainer.className = 'search-bar';
                DoctumSearch.doctumSearchPageAutoCompleteProgressBar.className = 'progress-bar indeterminate';
            }
    },
    markProgressFinished: function () {
        Doctum.doctumSearchAutoCompleteProgressBarContainer.className = 'search-bar hidden';
        Doctum.doctumSearchAutoCompleteProgressBar.className = 'progress-bar';
        if (typeof DoctumSearch === 'object' && DoctumSearch.pageFullyLoaded) {
            DoctumSearch.doctumSearchPageAutoCompleteProgressBarContainer.className = 'search-bar hidden';
            DoctumSearch.doctumSearchPageAutoCompleteProgressBar.className = 'progress-bar';
        }
    },
    makeProgess: function () {
        Doctum.makeProgressOnProgressBar(
            Doctum.doctumSearchAutoCompleteProgressBarPercent,
            Doctum.doctumSearchAutoCompleteProgressBar
        );
        if (typeof DoctumSearch === 'object' && DoctumSearch.pageFullyLoaded) {
            Doctum.makeProgressOnProgressBar(
                Doctum.doctumSearchAutoCompleteProgressBarPercent,
                DoctumSearch.doctumSearchPageAutoCompleteProgressBar
            );
        }
    },
    loadAutoCompleteData: function (query) {
        return new Promise(function (resolve, reject) {
            if (Doctum.autoCompleteData !== null) {
                resolve(Doctum.autoCompleteData);
                return;
            }
            Doctum.markInProgress();
            function reqListener() {
                Doctum.autoCompleteLoading = false;
                Doctum.autoCompleteData = JSON.parse(this.responseText).items;
                Doctum.markProgressFinished();

                setTimeout(function () {
                    resolve(Doctum.autoCompleteData);
                }, 50);// Let the UI render once before sending the results for processing. This gives time to the progress bar to hide
            }
            function reqError(err) {
                Doctum.autoCompleteLoading = false;
                Doctum.autoCompleteData = null;
                console.error(err);
                reject(err);
            }

            var oReq = new XMLHttpRequest();
            oReq.onload = reqListener;
            oReq.onerror = reqError;
            oReq.onprogress = function (pe) {
                if (pe.lengthComputable) {
                    Doctum.doctumSearchAutoCompleteProgressBarPercent = parseInt(pe.loaded / pe.total * 100, 10);
                    Doctum.makeProgess();
                }
            };
            oReq.onloadend = function (_) {
                Doctum.markProgressFinished();
            };
            oReq.open('get', Doctum.autoCompleteDataUrl, true);
            oReq.send();
        });
    },
    /**
     * Make some progress on a progress bar
     *
     * @param number percentage
     * @param HTMLElement progressBar
     * @return void
     */
    makeProgressOnProgressBar: function(percentage, progressBar) {
        progressBar.className = 'progress-bar';
        progressBar.style.width = percentage + '%';
        progressBar.setAttribute(
            'aria-valuenow', percentage
        );
    },
    searchEngine: function (query, record) {
        if (typeof query !== 'string') {
            return '';
        }
        // replace all (mode = g) spaces and non breaking spaces (\s) by pipes
        // g = global mode to mark also the second word searched
        // i = case insensitive
        // how this function works:
        // First: search if the query has the keywords in sequence
        // Second: replace the keywords by a mark and leave all the text in between non marked
        
        if (record.match(new RegExp('(' + query.replace(/\s/g, ').*(') + ')', 'gi')) === null) {
            return '';// Does not match
        }

        var replacedRecord = record.replace(new RegExp('(' + query.replace(/\s/g, '|') + ')', 'gi'), function (group) {
            return '<mark class="auto-complete-highlight">' + group + '</mark>';
        });

        if (replacedRecord !== record) {
            return replacedRecord;// This should not happen but just in case there was no match done
        }

        return '';
    },
    /**
     * Clean the search query
     *
     * @param string query
     * @return string
     */
    cleanSearchQuery: function (query) {
        // replace any chars that could lead to injecting code in our regex
        // remove start or end spaces
        // replace backslashes by an escaped version, use case in search: \myRootFunction
        return query.replace(Doctum.querySearchSecurityRegex, '').trim().replace(/\\/g, '\\\\');
    },
    bootAutoComplete: function () {
        Doctum.autoCompleteJS = new autoComplete(
            {
                selector: '#doctum-search-auto-complete',
                searchEngine: function (query, record) {
                    return Doctum.searchEngine(query, record);
                },
                submit: true,
                data: {
                    src: function (q) {
                        Doctum.markInProgress();
                        return Doctum.loadAutoCompleteData(q);
                    },
                    keys: ['n'],// Data 'Object' key to be searched
                    cache: false, // Is not compatible with async fetch of data
                },
                query: (input) => {
                    return Doctum.cleanSearchQuery(input);
                },
                trigger: (query) => {
                    return Doctum.cleanSearchQuery(query).length > 0;
                },
                resultsList: {
                    tag: 'ul',
                    class: 'auto-complete-dropdown-menu',
                    destination: '#auto-complete-results',
                    position: 'afterbegin',
                    maxResults: 500,
                    noResults: false,
                },
                resultItem: {
                    tag: 'li',
                    class: 'auto-complete-result',
                    highlight: 'auto-complete-highlight',
                    selected: 'auto-complete-selected'
                },
            }
        );
    }
};


document.addEventListener('DOMContentLoaded', Doctum.pagePartiallyLoaded, false);
window.addEventListener('load', Doctum.pageFullyLoaded, false);
