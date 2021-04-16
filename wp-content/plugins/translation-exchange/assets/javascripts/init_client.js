if (TmlConfig && TmlConfig.key) {
    var options = {
        host:               TmlConfig.host,
        key:                TmlConfig.key,
        translate_title:    true,
        translate_body:     true,
        debug:              false,
        translator_options: {
            ignore_elements: ['#wpadminbar', '.sd-content', '.blog-post-meta']
        }
    };

    if (TmlConfig.cache) {
        options.cache = TmlConfig.cache;
    }

    if (TmlConfig.advanced && TmlConfig.advanced != '') {
        try {
            var json = TmlConfig.advanced.replace(/\\"/g, '"').replace("\\r\\n", "");
            options = tml.utils.merge(options, JSON.parse(json));
        } catch(e) {
            console.log("tml: Failed to parse advanced options", e);
        }
    }

    tml.init(options);
}