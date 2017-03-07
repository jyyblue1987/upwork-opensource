<?php

/* webview/layout/twig/partials/connected-dropdown.twig */
class __TwigTemplate_c353d6a5c7928cafc2dbc40975b3e6cf9fad0dbb44b3d6945e570acda8a6171f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<li>
    <a href=\"";
        // line 2
        echo twig_escape_filter($this->env, site_url("messageboard"), "html", null, true);
        echo "\" 
       class=\"show_notification\" 
       ";
        // line 4
        if ((isset($context["notification"]) ? $context["notification"] : null)) {
            echo " style=\"color: #e84c3d !important;\" ";
        }
        echo " >
        
        ";
        // line 6
        if ((isset($context["notification"]) ? $context["notification"] : null)) {
            // line 7
            echo "           <span style=\"color: #e84c3d;padding: 0 5px;\">";
            echo twig_escape_filter($this->env, (isset($context["notification"]) ? $context["notification"] : null), "html", null, true);
            echo "</span>
        ";
        }
        // line 9
        echo "        <i class=\"fa fa-envelope-o \" aria-hidden=\"true\"></i>
    </a>
</li>
<!-- TODO: Add notification dropdown option here -->
<li>
    <a href=\"javascript:void(0);\" data-toggle=\"dropdown\"> 
        HI ";
        // line 15
        echo twig_escape_filter($this->env, twig_upper_filter($this->env, $this->getAttribute(app_user_data(), "fname", array(), "array")), "html", null, true);
        echo " 
        <i class=\"fa fa-caret-down\" aria-hidden=\"true\" ></i>
    </a>
    <ul class=\"dropdown-menu\">
        ";
        // line 19
        if (($this->getAttribute(app_user_data(), "type", array(), "array") == "2")) {
            // line 20
            echo "            <li><a href=\"";
            echo twig_escape_filter($this->env, site_url("profile-settings"), "html", null, true);
            echo "\">My Profile</a></li>
        ";
        }
        // line 22
        echo "        <li><a href=\"";
        echo twig_escape_filter($this->env, site_url("profile-settings"), "html", null, true);
        echo "\">Settings</a></li>
        <li><a href=\"";
        // line 23
        echo twig_escape_filter($this->env, site_url("logout/"), "html", null, true);
        echo "\">Logout</a></li>
    </ul>
</li>
";
    }

    public function getTemplateName()
    {
        return "webview/layout/twig/partials/connected-dropdown.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  70 => 23,  65 => 22,  59 => 20,  57 => 19,  50 => 15,  42 => 9,  36 => 7,  34 => 6,  27 => 4,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<li>
    <a href=\"{{ site_url(\"messageboard\") }}\" 
       class=\"show_notification\" 
       {% if notification %} style=\"color: #e84c3d !important;\" {% endif %} >
        
        {% if notification %}
           <span style=\"color: #e84c3d;padding: 0 5px;\">{{ notification }}</span>
        {% endif %}
        <i class=\"fa fa-envelope-o \" aria-hidden=\"true\"></i>
    </a>
</li>
<!-- TODO: Add notification dropdown option here -->
<li>
    <a href=\"javascript:void(0);\" data-toggle=\"dropdown\"> 
        HI {{ app_user_data()['fname']|upper }} 
        <i class=\"fa fa-caret-down\" aria-hidden=\"true\" ></i>
    </a>
    <ul class=\"dropdown-menu\">
        {% if app_user_data()['type'] == '2' %}
            <li><a href=\"{{ site_url(\"profile-settings\") }}\">My Profile</a></li>
        {% endif %}
        <li><a href=\"{{ site_url(\"profile-settings\") }}\">Settings</a></li>
        <li><a href=\"{{ site_url(\"logout/\") }}\">Logout</a></li>
    </ul>
</li>
", "webview/layout/twig/partials/connected-dropdown.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\layout\\twig\\partials\\connected-dropdown.twig");
    }
}
