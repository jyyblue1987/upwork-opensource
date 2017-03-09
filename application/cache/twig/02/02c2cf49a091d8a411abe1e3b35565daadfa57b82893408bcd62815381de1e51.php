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
        
        <!-- Block to load specific page style -->
        ";
        // line 30
        $this->displayBlock('styles', $context, $blocks);
        // line 31
        echo "        
    </head>
    <body>
        
        ";
        // line 35
        echo twig_include($this->env, $context, "webview/layout/twig/partials/header.twig");
        echo "
        
        <section class=\"main_area\"  id=\"mid_contant\"  >
            <div class=\"container\">
                <!-- Block to load content page -->
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
        
        <script src=\"";
        // line 46
        echo twig_escape_filter($this->env, site_url("assets/js/vendor/jquery-2.2.3.min.js"), "html", null, true);
        echo "\"></script>
        <script src=\"";
        // line 47
        echo twig_escape_filter($this->env, site_url("assets/js/bootstrap.min.js"), "html", null, true);
        echo "\"></script>
        <script src=\"";
        // line 48
        echo twig_escape_filter($this->env, site_url("assets/js/plugins.js"), "html", null, true);
        echo "\"></script>        
        <script src=\"";
        // line 49
        echo twig_escape_filter($this->env, site_url("assets/js/bootstrap-datepicker.js"), "html", null, true);
        echo "\"></script>
        <script src=\"";
        // line 50
        echo twig_escape_filter($this->env, site_url("assets/js/main.js"), "html", null, true);
        echo "\"></script>
        <script src=\"";
        // line 51
        echo twig_escape_filter($this->env, site_url("assets/range/jquery_range.js"), "html", null, true);
        echo "\"></script>
        <script src=\"";
        // line 52
        echo twig_escape_filter($this->env, site_url("assets/range/jquery-ui.js"), "html", null, true);
        echo "\"> </script>
        <script src=\"";
        // line 53
        echo twig_escape_filter($this->env, site_url("assets/global/vendor/formvalidation/formValidation.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
        <script src=\"";
        // line 54
        echo twig_escape_filter($this->env, site_url("assets/js/reCaptcha2.min.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
        <script src=\"";
        // line 55
        echo twig_escape_filter($this->env, site_url("assets/global/vendor/formvalidation/framework/bootstrap.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
        <script src=\"https://use.fontawesome.com/73754fb9b3.js\"></script>
        <script src=\"";
        // line 57
        echo twig_escape_filter($this->env, site_url("assets/js/vendor/modernizr-2.8.3.min.js"), "html", null, true);
        echo "\"></script>
        <script> var site_url=\"";
        // line 58
        echo twig_escape_filter($this->env, site_url(), "html", null, true);
        echo "\"; </script>
        
        <!-- Block to load specific page script -->
        ";
        // line 61
        $this->displayBlock('js', $context, $blocks);
        // line 62
        echo "        
    </body>
</html>";
    }

    // line 30
    public function block_styles($context, array $blocks = array())
    {
    }

    // line 40
    public function block_content($context, array $blocks = array())
    {
    }

    // line 61
    public function block_js($context, array $blocks = array())
    {
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
        return array (  198 => 61,  193 => 40,  188 => 30,  182 => 62,  180 => 61,  174 => 58,  170 => 57,  165 => 55,  161 => 54,  157 => 53,  153 => 52,  149 => 51,  145 => 50,  141 => 49,  137 => 48,  133 => 47,  129 => 46,  124 => 44,  119 => 41,  117 => 40,  109 => 35,  103 => 31,  101 => 30,  95 => 27,  91 => 26,  87 => 25,  83 => 24,  79 => 23,  75 => 22,  71 => 21,  67 => 20,  63 => 19,  59 => 18,  55 => 17,  51 => 16,  47 => 15,  43 => 14,  39 => 13,  32 => 9,  22 => 1,);
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
        
        <!-- Block to load specific page style -->
        {% block styles %}{% endblock %}
        
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
        <script> var site_url=\"{{ site_url() }}\"; </script>
        
        <!-- Block to load specific page script -->
        {% block js %}{% endblock %}
        
    </body>
</html>", "webview/layout/twig/layout.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\layout\\twig\\layout.twig");
    }
}
