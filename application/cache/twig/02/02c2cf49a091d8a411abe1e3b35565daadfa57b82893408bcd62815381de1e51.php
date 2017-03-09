<?php

/* webview/layout/twig/layout.twig */
class __TwigTemplate_3afcc098042bf239eb9d6ca499bc2e0d08453b4d66a7730ada2ee1033d6e468b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'styles' => array($this, 'block_styles'),
            'content' => array($this, 'block_content'),
            'js' => array($this, 'block_js'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
    <head>
        <meta charset=\"utf-8\">
        <meta http-equiv=\"x-ua-compatible\" content=\"ie=edge\">
        <title>HOME</title>
        <meta name=\"description\" content=\"\">
\t<meta name=\"viewport\" content=\"width=device-width,height=device-height, initial-scale=1, user-scalable=no\">
        <link rel=\"apple-touch-icon\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, site_url("assets/apple-touch-icon.png"), "html", null, true);
        echo "\">        
        
        <!-- Block to load common style which can be overrided by a specific page -->
        ";
        // line 12
        $this->displayBlock('styles', $context, $blocks);
        // line 29
        echo "        
    </head>
    <body>
        
        ";
        // line 33
        echo twig_include($this->env, $context, "webview/layout/twig/partials/header.twig");
        echo "
        
        <section class=\"main_area\"  id=\"mid_contant\"  >
            <div class=\"container\">
                <!-- Block to load content page -->
                ";
        // line 38
        $this->displayBlock('content', $context, $blocks);
        // line 39
        echo "            </div>
        </section>
            
        ";
        // line 42
        echo twig_include($this->env, $context, "webview/layout/twig/partials/footer.twig");
        echo "
        
        
        <script> var site_url=\"";
        // line 45
        echo twig_escape_filter($this->env, site_url(), "html", null, true);
        echo "\"; </script>
        
        <!-- Block to load common scripts which can be overrided by a specific page  -->
        ";
        // line 48
        $this->displayBlock('js', $context, $blocks);
        // line 62
        echo "        
    </body>
</html>";
    }

    // line 12
    public function block_styles($context, array $blocks = array())
    {
        // line 13
        echo "            <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, site_url("assets/css/bootstrap.min.css"), "html", null, true);
        echo "\">
            <link rel=\"stylesheet\" href=\"";
        // line 14
        echo twig_escape_filter($this->env, site_url("assets/css/font-awesome.min.css"), "html", null, true);
        echo "\">
            <link rel=\"stylesheet\" href=\"";
        // line 15
        echo twig_escape_filter($this->env, site_url("assets/css/fonts.css"), "html", null, true);
        echo "\">
            <link rel=\"stylesheet\" href=\"";
        // line 16
        echo twig_escape_filter($this->env, site_url("assets/css/header.css"), "html", null, true);
        echo "\">
            <link rel=\"stylesheet\" href=\"";
        // line 17
        echo twig_escape_filter($this->env, site_url("assets/css/croppic.css"), "html", null, true);
        echo "\">
            <link rel=\"stylesheet\" href=\"";
        // line 18
        echo twig_escape_filter($this->env, site_url("assets/css/footer.css"), "html", null, true);
        echo "\">
            <link rel=\"stylesheet\" href=\"";
        // line 19
        echo twig_escape_filter($this->env, site_url("assets/css/bootstrap-socil.css"), "html", null, true);
        echo "\">
            <link rel=\"stylesheet\" href=\"";
        // line 20
        echo twig_escape_filter($this->env, site_url("assets/css/normalize.css"), "html", null, true);
        echo "\">
            <link rel=\"stylesheet\" href=\"";
        // line 21
        echo twig_escape_filter($this->env, site_url("assets/css/style.css"), "html", null, true);
        echo "\">
            <link rel=\"stylesheet\" href=\"";
        // line 22
        echo twig_escape_filter($this->env, site_url("assets/css/bootstrap-social.css"), "html", null, true);
        echo "\">
            <link href=\"";
        // line 23
        echo twig_escape_filter($this->env, site_url("assets/range/jquery-ui.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">
            <link rel='stylesheet' media='screen and (min-width: 0px) and (max-width: 5000px)' href='";
        // line 24
        echo twig_escape_filter($this->env, site_url("assets/css/lg-style.css"), "html", null, true);
        echo "' />
            <link rel='stylesheet' media='screen and (min-width: 0px) and (max-width: 1199px)' href='";
        // line 25
        echo twig_escape_filter($this->env, site_url("assets/css/md-style.css"), "html", null, true);
        echo "' />
            <link rel='stylesheet' media='screen and (min-width: 0px) and (max-width: 991px)' href='";
        // line 26
        echo twig_escape_filter($this->env, site_url("assets/css/sm-style.css"), "html", null, true);
        echo "' />
            <link rel='stylesheet' media='screen and (min-width: 0px) and (max-width: 767px)' href='";
        // line 27
        echo twig_escape_filter($this->env, site_url("assets/css/xs-style.css"), "html", null, true);
        echo "' />
        ";
    }

    // line 38
    public function block_content($context, array $blocks = array())
    {
    }

    // line 48
    public function block_js($context, array $blocks = array())
    {
        // line 49
        echo "            <script src=\"";
        echo twig_escape_filter($this->env, site_url("assets/js/vendor/jquery-2.2.3.min.js"), "html", null, true);
        echo "\"></script>
            <script src=\"";
        // line 50
        echo twig_escape_filter($this->env, site_url("assets/js/bootstrap.min.js"), "html", null, true);
        echo "\"></script>
            <script src=\"";
        // line 51
        echo twig_escape_filter($this->env, site_url("assets/js/plugins.js"), "html", null, true);
        echo "\"></script>        
            <script src=\"";
        // line 52
        echo twig_escape_filter($this->env, site_url("assets/js/bootstrap-datepicker.js"), "html", null, true);
        echo "\"></script>
            <script src=\"";
        // line 53
        echo twig_escape_filter($this->env, site_url("assets/js/main.js"), "html", null, true);
        echo "\"></script>
            <script src=\"";
        // line 54
        echo twig_escape_filter($this->env, site_url("assets/range/jquery_range.js"), "html", null, true);
        echo "\"></script>
            <script src=\"";
        // line 55
        echo twig_escape_filter($this->env, site_url("assets/range/jquery-ui.js"), "html", null, true);
        echo "\"> </script>
            <script src=\"";
        // line 56
        echo twig_escape_filter($this->env, site_url("assets/global/vendor/formvalidation/formValidation.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
            <script src=\"";
        // line 57
        echo twig_escape_filter($this->env, site_url("assets/js/reCaptcha2.min.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
            <script src=\"";
        // line 58
        echo twig_escape_filter($this->env, site_url("assets/global/vendor/formvalidation/framework/bootstrap.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
            <script src=\"https://use.fontawesome.com/73754fb9b3.js\"></script>
            <script src=\"";
        // line 60
        echo twig_escape_filter($this->env, site_url("assets/js/vendor/modernizr-2.8.3.min.js"), "html", null, true);
        echo "\"></script>
        ";
    }

    public function getTemplateName()
    {
        return "webview/layout/twig/layout.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  197 => 60,  192 => 58,  188 => 57,  184 => 56,  180 => 55,  176 => 54,  172 => 53,  168 => 52,  164 => 51,  160 => 50,  155 => 49,  152 => 48,  147 => 38,  141 => 27,  137 => 26,  133 => 25,  129 => 24,  125 => 23,  121 => 22,  117 => 21,  113 => 20,  109 => 19,  105 => 18,  101 => 17,  97 => 16,  93 => 15,  89 => 14,  84 => 13,  81 => 12,  75 => 62,  73 => 48,  67 => 45,  61 => 42,  56 => 39,  54 => 38,  46 => 33,  40 => 29,  38 => 12,  32 => 9,  22 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html lang=\"en\">
    <head>
        <meta charset=\"utf-8\">
        <meta http-equiv=\"x-ua-compatible\" content=\"ie=edge\">
        <title>HOME</title>
        <meta name=\"description\" content=\"\">
\t<meta name=\"viewport\" content=\"width=device-width,height=device-height, initial-scale=1, user-scalable=no\">
        <link rel=\"apple-touch-icon\" href=\"{{ site_url(\"assets/apple-touch-icon.png\") }}\">        
        
        <!-- Block to load common style which can be overrided by a specific page -->
        {% block styles %}
            <link rel=\"stylesheet\" href=\"{{ site_url(\"assets/css/bootstrap.min.css\") }}\">
            <link rel=\"stylesheet\" href=\"{{ site_url(\"assets/css/font-awesome.min.css\") }}\">
            <link rel=\"stylesheet\" href=\"{{ site_url(\"assets/css/fonts.css\") }}\">
            <link rel=\"stylesheet\" href=\"{{ site_url(\"assets/css/header.css\") }}\">
            <link rel=\"stylesheet\" href=\"{{ site_url(\"assets/css/croppic.css\") }}\">
            <link rel=\"stylesheet\" href=\"{{ site_url(\"assets/css/footer.css\") }}\">
            <link rel=\"stylesheet\" href=\"{{ site_url(\"assets/css/bootstrap-socil.css\") }}\">
            <link rel=\"stylesheet\" href=\"{{ site_url(\"assets/css/normalize.css\") }}\">
            <link rel=\"stylesheet\" href=\"{{ site_url(\"assets/css/style.css\") }}\">
            <link rel=\"stylesheet\" href=\"{{ site_url(\"assets/css/bootstrap-social.css\") }}\">
            <link href=\"{{ site_url(\"assets/range/jquery-ui.css\") }}\" rel=\"stylesheet\">
            <link rel='stylesheet' media='screen and (min-width: 0px) and (max-width: 5000px)' href='{{ site_url(\"assets/css/lg-style.css\") }}' />
            <link rel='stylesheet' media='screen and (min-width: 0px) and (max-width: 1199px)' href='{{ site_url(\"assets/css/md-style.css\") }}' />
            <link rel='stylesheet' media='screen and (min-width: 0px) and (max-width: 991px)' href='{{ site_url(\"assets/css/sm-style.css\") }}' />
            <link rel='stylesheet' media='screen and (min-width: 0px) and (max-width: 767px)' href='{{ site_url(\"assets/css/xs-style.css\") }}' />
        {% endblock %}
        
    </head>
    <body>
        
        {{ include('webview/layout/twig/partials/header.twig') }}
        
        <section class=\"main_area\"  id=\"mid_contant\"  >
            <div class=\"container\">
                <!-- Block to load content page -->
                {% block content %}{% endblock %}
            </div>
        </section>
            
        {{ include('webview/layout/twig/partials/footer.twig') }}
        
        
        <script> var site_url=\"{{ site_url() }}\"; </script>
        
        <!-- Block to load common scripts which can be overrided by a specific page  -->
        {% block js %}
            <script src=\"{{ site_url(\"assets/js/vendor/jquery-2.2.3.min.js\") }}\"></script>
            <script src=\"{{ site_url(\"assets/js/bootstrap.min.js\") }}\"></script>
            <script src=\"{{ site_url(\"assets/js/plugins.js\") }}\"></script>        
            <script src=\"{{ site_url(\"assets/js/bootstrap-datepicker.js\") }}\"></script>
            <script src=\"{{ site_url(\"assets/js/main.js\") }}\"></script>
            <script src=\"{{ site_url(\"assets/range/jquery_range.js\") }}\"></script>
            <script src=\"{{ site_url(\"assets/range/jquery-ui.js\") }}\"> </script>
            <script src=\"{{ site_url(\"assets/global/vendor/formvalidation/formValidation.js\") }}\" type=\"text/javascript\"></script>
            <script src=\"{{ site_url(\"assets/js/reCaptcha2.min.js\") }}\" type=\"text/javascript\"></script>
            <script src=\"{{ site_url(\"assets/global/vendor/formvalidation/framework/bootstrap.js\") }}\" type=\"text/javascript\"></script>
            <script src=\"https://use.fontawesome.com/73754fb9b3.js\"></script>
            <script src=\"{{ site_url(\"assets/js/vendor/modernizr-2.8.3.min.js\") }}\"></script>
        {% endblock %}
        
    </body>
</html>", "webview/layout/twig/layout.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\layout\\twig\\layout.twig");
    }
}
