<?php

/* webview/layout/twig/layout.twig */
class __TwigTemplate_3afcc098042bf239eb9d6ca499bc2e0d08453b4d66a7730ada2ee1033d6e468b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
            'commonjs' => array($this, 'block_commonjs'),
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
        
        <!-- Loading jquery here... -->

        <link rel=\"stylesheet\" href=\"";
        // line 13
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
        <script src=\"https://use.fontawesome.com/73754fb9b3.js\"></script>

        <script src=\"";
        // line 30
        echo twig_escape_filter($this->env, site_url("assets/js/vendor/modernizr-2.8.3.min.js"), "html", null, true);
        echo "\"></script>
                
        <script> var siteurl=\"";
        // line 32
        echo twig_escape_filter($this->env, site_url(), "html", null, true);
        echo "\"; </script>
    </head>
    <body>
        
        ";
        // line 36
        echo twig_include($this->env, $context, "webview/layout/twig/partials/header.twig");
        echo "
        
        <section class=\"main_area\"  id=\"mid_contant\"  >
            <div class=\"container\">
                ";
        // line 40
        $this->displayBlock('content', $context, $blocks);
        // line 41
        echo "            </div>
        </section>
            
        ";
        // line 44
        echo twig_include($this->env, $context, "webview/layout/twig/partials/footer.twig");
        echo "
        
        ";
        // line 46
        $this->displayBlock('commonjs', $context, $blocks);
        // line 49
        echo "        
    </body>
</html>";
    }

    // line 40
    public function block_content($context, array $blocks = array())
    {
    }

    // line 46
    public function block_commonjs($context, array $blocks = array())
    {
        // line 47
        echo "            <script data-main=\"";
        echo twig_escape_filter($this->env, app_modular_js("lib/require.js"), "html", null, true);
        echo "\" src=\"";
        echo twig_escape_filter($this->env, app_modular_js("lib/require.js"), "html", null, true);
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
        return array (  147 => 47,  144 => 46,  139 => 40,  133 => 49,  131 => 46,  126 => 44,  121 => 41,  119 => 40,  112 => 36,  105 => 32,  100 => 30,  94 => 27,  90 => 26,  86 => 25,  82 => 24,  78 => 23,  74 => 22,  70 => 21,  66 => 20,  62 => 19,  58 => 18,  54 => 17,  50 => 16,  46 => 15,  42 => 14,  38 => 13,  31 => 9,  21 => 1,);
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
        
        <!-- Loading jquery here... -->

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
        <script src=\"https://use.fontawesome.com/73754fb9b3.js\"></script>

        <script src=\"{{ site_url(\"assets/js/vendor/modernizr-2.8.3.min.js\") }}\"></script>
                
        <script> var siteurl=\"{{ site_url() }}\"; </script>
    </head>
    <body>
        
        {{ include('webview/layout/twig/partials/header.twig') }}
        
        <section class=\"main_area\"  id=\"mid_contant\"  >
            <div class=\"container\">
                {% block content %}{% endblock %}
            </div>
        </section>
            
        {{ include('webview/layout/twig/partials/footer.twig') }}
        
        {% block commonjs %}
            <script data-main=\"{{ app_modular_js(\"lib/require.js\") }}\" src=\"{{ app_modular_js(\"lib/require.js\") }}\"></script>
        {% endblock %}
        
    </body>
</html>", "webview/layout/twig/layout.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\layout\\twig\\layout.twig");
    }
}
