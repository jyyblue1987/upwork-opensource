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
            echo " ";
            echo "style=\"color: #e84c3d !important;\"";
            echo " ";
        }
        echo ">
        ";
        // line 5
        if ((isset($context["notification"]) ? $context["notification"] : null)) {
            echo " 
           <span style=\"color: #e84c3d;padding: 0 5px;\">";
            // line 6
            echo twig_escape_filter($this->env, (isset($context["notification"]) ? $context["notification"] : null), "html", null, true);
            echo "</span>
        ";
        }
        // line 8
        echo "        <i class=\"fa fa-envelope-o \" aria-hidden=\"true\"></i>
    </a>
    ";
        // line 10
        if ((isset($context["notification_details"]) ? $context["notification_details"] : null)) {
            // line 11
            echo "        <div class=\"notification\" style=\"display: none;\" >
            ";
            // line 12
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["notification_details"]) ? $context["notification_details"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["data"]) {
                // line 13
                echo "                <p class=\"noti-block\">
                    <a href=\"/messageboard?bid_id=";
                // line 14
                echo twig_escape_filter($this->env, base64_encode($this->getAttribute($context["data"], "bid_id", array())), "html", null, true);
                echo "\">
                        <span class=\"name\">
                            <img src=\"";
                // line 16
                echo twig_escape_filter($this->env, app_user_img($this->getAttribute($context["data"], "cropped_image", array())), "html", null, true);
                echo "\" >
                            ";
                // line 17
                echo twig_escape_filter($this->env, $this->getAttribute($context["data"], "webuser_fname", array()), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["data"], "webuser_lname", array()), "html", null, true);
                echo "
                        </span>
                        <span class=\"details\">";
                // line 19
                echo twig_escape_filter($this->env, character_limiter($this->getAttribute($context["data"], "message_conversation", array()), 80, "..."), "html", null, true);
                echo "</span>
                    </a>
                </p>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['data'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 23
            echo "        </div>
    ";
        }
        // line 25
        echo "</li>

<li>    
    <a href=\"javascript:void(0);\" data-toggle=\"dropdown\"> 
        <i class=\"fa fa-bell-o\" aria-hidden=\"true\" ></i> 
    </a>
    <div class=\"";
        // line 31
        if (((isset($context["notif_count"]) ? $context["notif_count"] : null) > 0)) {
            echo " ";
            echo "notif-alert";
            echo " ";
        }
        echo "\">
        <span>";
        // line 32
        if (((isset($context["notif_count"]) ? $context["notif_count"] : null) > 0)) {
            echo " ";
            echo twig_escape_filter($this->env, (isset($context["notif_count"]) ? $context["notif_count"] : null), "html", null, true);
            echo " ";
        }
        echo "</span>
    </div>
    <ul class=\"dropdown-menu notif-dropdown\">
        ";
        // line 35
        if (((isset($context["notif_count"]) ? $context["notif_count"] : null) > 0)) {
            // line 36
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["notifications"]) ? $context["notifications"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["notif"]) {
                // line 37
                echo "                <li><a href=\"";
                echo twig_escape_filter($this->env, site_url("notification/check/{ notif.id_notification }"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($context["notif"], "description", array()), "html", null, true);
                echo "</a></li> 
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['notif'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 39
            echo "        ";
        } else {
            // line 40
            echo "            <li> ";
            echo twig_escape_filter($this->env, app_lang("text_app_no_notification"), "html", null, true);
            echo " </li>
        ";
        }
        // line 42
        echo "    </ul>
</li>

<li>
    <a href=\"javascript:void(0);\" data-toggle=\"dropdown\"> 
        HI ";
        // line 47
        echo twig_escape_filter($this->env, twig_upper_filter($this->env, $this->getAttribute(app_user_data(), "fname", array(), "array")), "html", null, true);
        echo " 
        <i class=\"fa fa-caret-down\" aria-hidden=\"true\" ></i>
    </a>
    <ul class=\"dropdown-menu\">
        ";
        // line 51
        if (($this->getAttribute(app_user_data(), "type", array(), "array") == "2")) {
            // line 52
            echo "            <li><a href=\"";
            echo twig_escape_filter($this->env, site_url("profile-settings"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, app_lang("text_app_my_profile"), "html", null, true);
            echo "</a></li>
        ";
        }
        // line 54
        echo "        <li><a href=\"";
        echo twig_escape_filter($this->env, site_url("profile-settings"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, app_lang("text_app_user_settings"), "html", null, true);
        echo "</a></li>
        <li><a href=\"";
        // line 55
        echo twig_escape_filter($this->env, site_url("logout/"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, app_lang("text_app_logout"), "html", null, true);
        echo "</a></li>
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
        return array (  174 => 55,  167 => 54,  159 => 52,  157 => 51,  150 => 47,  143 => 42,  137 => 40,  134 => 39,  123 => 37,  118 => 36,  116 => 35,  106 => 32,  98 => 31,  90 => 25,  86 => 23,  76 => 19,  69 => 17,  65 => 16,  60 => 14,  57 => 13,  53 => 12,  50 => 11,  48 => 10,  44 => 8,  39 => 6,  35 => 5,  27 => 4,  22 => 2,  19 => 1,);
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
        {% if notification %} {{ 'style=\"color: #e84c3d !important;\"' }} {% endif %}>
        {% if notification %} 
           <span style=\"color: #e84c3d;padding: 0 5px;\">{{ notification }}</span>
        {% endif %}
        <i class=\"fa fa-envelope-o \" aria-hidden=\"true\"></i>
    </a>
    {% if notification_details %}
        <div class=\"notification\" style=\"display: none;\" >
            {% for data in notification_details %}
                <p class=\"noti-block\">
                    <a href=\"/messageboard?bid_id={{ base64_encode( data.bid_id ) }}\">
                        <span class=\"name\">
                            <img src=\"{{ app_user_img( data.cropped_image ) }}\" >
                            {{ data.webuser_fname }} {{ data.webuser_lname }}
                        </span>
                        <span class=\"details\">{{ character_limiter( data.message_conversation, 80, '...') }}</span>
                    </a>
                </p>
            {% endfor %}
        </div>
    {% endif %}
</li>

<li>    
    <a href=\"javascript:void(0);\" data-toggle=\"dropdown\"> 
        <i class=\"fa fa-bell-o\" aria-hidden=\"true\" ></i> 
    </a>
    <div class=\"{% if notif_count > 0 %} {{ 'notif-alert' }} {% endif %}\">
        <span>{% if notif_count > 0 %} {{ notif_count }} {% endif %}</span>
    </div>
    <ul class=\"dropdown-menu notif-dropdown\">
        {% if notif_count > 0 %}
            {% for notif in notifications %}
                <li><a href=\"{{ site_url(\"notification/check/{ notif.id_notification }\") }}\">{{ notif.description }}</a></li> 
            {% endfor %}
        {% else %}
            <li> {{ app_lang('text_app_no_notification') }} </li>
        {% endif %}
    </ul>
</li>

<li>
    <a href=\"javascript:void(0);\" data-toggle=\"dropdown\"> 
        HI {{ app_user_data()['fname']|upper }} 
        <i class=\"fa fa-caret-down\" aria-hidden=\"true\" ></i>
    </a>
    <ul class=\"dropdown-menu\">
        {% if app_user_data()['type'] == '2' %}
            <li><a href=\"{{ site_url(\"profile-settings\") }}\">{{ app_lang('text_app_my_profile') }}</a></li>
        {% endif %}
        <li><a href=\"{{ site_url(\"profile-settings\") }}\">{{ app_lang('text_app_user_settings') }}</a></li>
        <li><a href=\"{{ site_url(\"logout/\") }}\">{{ app_lang('text_app_logout') }}</a></li>
    </ul>
</li>
", "webview/layout/twig/partials/connected-dropdown.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\layout\\twig\\partials\\connected-dropdown.twig");
    }
}
