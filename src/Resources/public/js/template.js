/**
 * @author <Vladimir Odesskij> [odesskij1992@gmail.com]
 */
define(['text', 'routing', 'templating'], function (text, Routing, templating) {
  'use strict';
  return {
    "load": function (name, req, onLoad, config) {
      if (config.isBuild) {
        onLoad(null);
      } else {
        text.get(Routing.generate('ajax_templating', {
            "template": name
          }), function (data) {
            try {
              JSON.parse(data).forEach(function (item) {
                templating.addTemplate(item.name, item.source);
              });
              onLoad(templating.get(name));
            } catch (e) {
              onLoad.error(e);
            }
          },
          onLoad.error, {
            "accept": 'application/json'
          }
        );
      }
    }
  };
});
