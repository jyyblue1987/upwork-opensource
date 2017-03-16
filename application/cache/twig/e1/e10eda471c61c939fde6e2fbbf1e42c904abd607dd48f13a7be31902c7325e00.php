<?php

/* webview/jobs/twig/contract.twig */
class __TwigTemplate_0e3ffd94f0d78bb3b0fba7b33a695e079c4f7e74868d1817d610c6a54cd2aa42 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("webview/layout/twig/layout.twig", "webview/jobs/twig/contract.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'styles' => array($this, 'block_styles'),
            'content' => array($this, 'block_content'),
            'js' => array($this, 'block_js'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "webview/layout/twig/layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 3
        if (twig_test_empty($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "hire_title", array()))) {
            // line 4
            $context["job_title"] = $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "title", array());
        } else {
            // line 6
            $context["job_title"] = $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "hire_title", array());
        }
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 9
    public function block_title($context, array $blocks = array())
    {
        echo "  ";
        echo twig_escape_filter($this->env, (isset($context["job_title"]) ? $context["job_title"] : null), "html", null, true);
        echo " - Winjob  ";
    }

    // line 11
    public function block_styles($context, array $blocks = array())
    {
        // line 12
        echo "    ";
        $this->displayParentBlock("styles", $context, $blocks);
        echo "
    
    <link rel=\"stylesheet\" href=\"";
        // line 14
        echo twig_escape_filter($this->env, base_url("assets/css/pages/job-common.css"), "html", null, true);
        echo "\">
    <link rel=\"stylesheet\" href=\"";
        // line 15
        echo twig_escape_filter($this->env, base_url("assets/css/pages/contract.css"), "html", null, true);
        echo "\">
";
    }

    // line 18
    public function block_content($context, array $blocks = array())
    {
        // line 19
        echo "    
    ";
        // line 20
        $context["job_id_encoded"] = base64_encode($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "job_id", array()));
        // line 21
        echo "    ";
        $context["fuser_id_encoded"] = base64_encode($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "fuser_id", array()));
        // line 22
        echo "    ";
        $context["buser_id_encoded"] = base64_encode($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "buser_id", array()));
        // line 23
        echo "    ";
        $context["bid_id_encoded"] = base64_encode($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "bid_id", array()));
        // line 24
        echo "    
    ";
        // line 25
        $context["chat_receiver_id"] = $this->getAttribute((isset($context["webuser"]) ? $context["webuser"] : null), "webuser_id", array());
        // line 26
        echo "    
    ";
        // line 27
        $context["_action"] = "client";
        // line 28
        echo "    
    ";
        // line 29
        $context["_query"] = "fuser";
        // line 30
        echo "    ";
        $context["param_userid"] = (isset($context["fuser_id_encoded"]) ? $context["fuser_id_encoded"] : null);
        // line 31
        echo "    ";
        if (($this->getAttribute(app_user_data(), "type", array(), "array") == twig_constant("FREELANCER"))) {
            // line 32
            echo "        ";
            $context["_action"] = "freelancer";
            // line 33
            echo "        ";
            $context["_query"] = "buser";
            // line 34
            echo "        ";
            $context["param_userid"] = (isset($context["buser_id_encoded"]) ? $context["buser_id_encoded"] : null);
            // line 35
            echo "    ";
        }
        // line 36
        echo "    
    <section id=\"big_header\" class=\"contract-section\">
        <div class=\"container\">
            <div class=\"row \">
                <div style=\"border: 1px solid #ccc;border-radius: 4px 4px 0 0px;margin: 0;\" class=\"col-md-9 white-box black-box\">
                    <div class=\"row\">
                        <div class=\"date_head\">
                            <div class=\"col-md-6\">";
        // line 43
        echo twig_escape_filter($this->env, sprintf(app_lang("text_job_since"), app_date($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "start_date", array()), " M j, Y ")), "html", null, true);
        echo "</div>
                            <div class=\"col-md-6\">
                                <div class=\"main_id\">
                                    <span>ID ";
        // line 46
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "contact_id", array()), "html", null, true);
        echo " </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-md-5\">
                            <div class=\"row\">
                                <div style=\"margin-left: 20px;\" class=\"col-md-4 col-md-offset-1 text-left\">
                                    <div class=\"st_img hourly_client_view_st_img\">
                                        <img src=\"";
        // line 56
        echo twig_escape_filter($this->env, app_user_img($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "cropped_image", array())), "html", null, true);
        echo "\" width=\"64\" height=\"64\" />
                                    </div>
                                </div>
                                <div style=\"margin-left: -24px;\" class=\"col-md-7 text-left\">
                                    <div class=\"hourly_name\">
                                        <h5 style=\"margin-top: -4px;\" class=\"free_name\">";
        // line 61
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "webuser_fname", array()), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "webuser_lname", array()), "html", null, true);
        echo "</h5>
                                        <p class=\"free_name\">
                                            ";
        // line 63
        if (($this->getAttribute(app_user_data(), "type", array(), "array") == twig_constant("FREELANCER"))) {
            // line 64
            echo "                                                ";
            echo twig_escape_filter($this->env, app_substr($this->getAttribute((isset($context["webuser"]) ? $context["webuser"] : null), "webuser_company", array()), twig_constant("CONTRACT_JOB_COMPANY_NAME_MAX"), "..."), "html", null, true);
            echo "
                                            ";
        } else {
            // line 66
            echo "                                                ";
            echo twig_escape_filter($this->env, app_substr($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "tagline", array()), twig_constant("CONTRACT_JOB_TITLE_MAX"), "..."), "html", null, true);
            echo "
                                            ";
        }
        // line 68
        echo "                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=\"col-md-3 text-center gray-text\">
                            <div style=\"margin-top: -8px;\" class=\"status_bar\">
                                ";
        // line 75
        if (($this->getAttribute((isset($context["webuser"]) ? $context["webuser"] : null), "isactive", array()) == 0)) {
            // line 76
            echo "                                    <label style=\"margin-top: -8px;\" class=\"gray-text\">
                                        ";
            // line 77
            $context["hold"] = "<span style='color:#ff0000;'>%s</span>";
            // line 78
            echo "                                        ";
            echo sprintf(sprintf(app_lang("text_job_status_state"), (isset($context["hold"]) ? $context["hold"] : null)), app_lang("text_job_state_hold"));
            echo "
                                    </label>
                                ";
        } elseif (($this->getAttribute(        // line 80
(isset($context["job_status"]) ? $context["job_status"] : null), "bid_status", array()) == 2)) {
            // line 81
            echo "                                    <label class=\"gray-text\">";
            echo twig_escape_filter($this->env, sprintf(app_lang("text_job_status_state"), app_lang("text_job_state_paused")), "html", null, true);
            echo "</label>
                                ";
        } elseif (($this->getAttribute(        // line 82
(isset($context["job_status"]) ? $context["job_status"] : null), "jobstatus", array()) == 1)) {
            // line 83
            echo "                                    <label class=\"gray-text\">";
            echo twig_escape_filter($this->env, sprintf(app_lang("text_job_status_state"), app_lang("text_job_state_ended")), "html", null, true);
            echo "</label>
                                ";
        } else {
            // line 85
            echo "                                    <label class=\"gray-text\">";
            echo twig_escape_filter($this->env, sprintf(app_lang("text_job_status_state"), app_lang("text_job_state_actived")), "html", null, true);
            echo "</label>
                                ";
        }
        // line 87
        echo "                            </div>
                        </div>
                        <div class=\"col-md-3 col-md-offset-1\">
                            <div class=\"msg_btnx hour_btn\">
                                <input type=\"button\" class=\"btn-primary transparent-btn big_mass_button _job_btn_message\" 
                                       value=\"";
        // line 92
        echo twig_escape_filter($this->env, app_lang("text_job_btn_message"), "html", null, true);
        echo "\" 
                                       data-bid=\"";
        // line 93
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "bid_id", array()), "html", null, true);
        echo "\"
                                       data-uid=\"";
        // line 94
        echo twig_escape_filter($this->env, (isset($context["chat_receiver_id"]) ? $context["chat_receiver_id"] : null), "html", null, true);
        echo "\"
                                       data-jid=\"";
        // line 95
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "job_id", array()), "html", null, true);
        echo "\" 
                                       />
                            </div>
                        </div>
                    </div>
                                       
                    <div class=\"col-md-12\">
                        <div class=\"job_title client_job_title\">
                            <span class=\"clint_view_j-title\">
                                ";
        // line 104
        echo twig_escape_filter($this->env, app_substr((isset($context["job_title"]) ? $context["job_title"] : null), twig_constant("CONTRACT_JOB_TITLE_MAX"), "..."), "html", null, true);
        echo "</span><br />
                            <a href=\"";
        // line 105
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "jobs/view/";
        echo twig_escape_filter($this->env, url_title($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "title", array())), "html", null, true);
        echo "/";
        echo twig_escape_filter($this->env, (isset($context["job_id_encoded"]) ? $context["job_id_encoded"] : null), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, app_lang("text_job_original_view"), "html", null, true);
        echo "</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class=\"bg-change\"></div>
            
            ";
        // line 113
        if (($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "job_type", array()) == twig_constant("FIXED_JOB_TYPE"))) {
            // line 114
            echo "                ";
            echo twig_include($this->env, $context, "webview/jobs/partials/job-nav-fixed-infos.twig");
            echo "
            ";
        } else {
            // line 116
            echo "                ";
            echo twig_include($this->env, $context, "webview/jobs/partials/job-nav-hourly-infos.twig");
            echo "
            ";
        }
        // line 118
        echo "            
        </div>
    </section>
    
    ";
        // line 122
        echo twig_include($this->env, $context, "webview/modals/message-conversion-modal.twig", array("webuser_fname" => $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "webuser_fname", array()), "webuser_lname" => $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "webuser_lname", array()), "job_title" => (isset($context["job_title"]) ? $context["job_title"] : null)));
        echo "
     
    ";
        // line 125
        echo "    ";
        if (($this->getAttribute(app_user_data(), "type", array(), "array") == twig_constant("EMPLOYER"))) {
            // line 126
            echo "        ";
            echo twig_include($this->env, $context, "webview/modals/milestone-modal.twig");
            echo "
        ";
            // line 127
            echo twig_include($this->env, $context, "webview/modals/payment-modal.twig");
            echo "
    ";
        }
        // line 129
        echo "    
";
    }

    // line 132
    public function block_js($context, array $blocks = array())
    {
        // line 133
        echo "    
    ";
        // line 135
        echo "    <script> var page = 'contract'; </script>
    
    <script data-main=\"";
        // line 137
        echo twig_escape_filter($this->env, app_modular_js("winjob"), "html", null, true);
        echo "\" src=\"";
        echo twig_escape_filter($this->env, app_modular_js("lib/require.dev.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 138
        echo twig_escape_filter($this->env, site_url("assets/js/vendor/modernizr-2.8.3.min.js"), "html", null, true);
        echo "\"></script>
    
";
    }

    public function getTemplateName()
    {
        return "webview/jobs/twig/contract.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  328 => 138,  322 => 137,  318 => 135,  315 => 133,  312 => 132,  307 => 129,  302 => 127,  297 => 126,  294 => 125,  289 => 122,  283 => 118,  277 => 116,  271 => 114,  269 => 113,  252 => 105,  248 => 104,  236 => 95,  232 => 94,  228 => 93,  224 => 92,  217 => 87,  211 => 85,  205 => 83,  203 => 82,  198 => 81,  196 => 80,  190 => 78,  188 => 77,  185 => 76,  183 => 75,  174 => 68,  168 => 66,  162 => 64,  160 => 63,  153 => 61,  145 => 56,  132 => 46,  126 => 43,  117 => 36,  114 => 35,  111 => 34,  108 => 33,  105 => 32,  102 => 31,  99 => 30,  97 => 29,  94 => 28,  92 => 27,  89 => 26,  87 => 25,  84 => 24,  81 => 23,  78 => 22,  75 => 21,  73 => 20,  70 => 19,  67 => 18,  61 => 15,  57 => 14,  51 => 12,  48 => 11,  40 => 9,  36 => 1,  33 => 6,  30 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"webview/layout/twig/layout.twig\" %}

{% if job_status.hire_title is empty %}
    {% set job_title = job_status.title %}
{% else %}
    {% set job_title = job_status.hire_title %}
{% endif  %}
                                    
{% block title %}  {{ job_title }} - Winjob  {% endblock %}

{% block styles %}
    {{ parent() }}
    
    <link rel=\"stylesheet\" href=\"{{ base_url(\"assets/css/pages/job-common.css\") }}\">
    <link rel=\"stylesheet\" href=\"{{ base_url(\"assets/css/pages/contract.css\") }}\">
{% endblock %}

{% block content %}
    
    {% set job_id_encoded   = base64_encode( job_status.job_id ) %}
    {% set fuser_id_encoded = base64_encode( job_status.fuser_id ) %}
    {% set buser_id_encoded = base64_encode( job_status.buser_id ) %}
    {% set bid_id_encoded   = base64_encode( job_status.bid_id) %}
    
    {% set chat_receiver_id = webuser.webuser_id %}
    
    {% set _action = 'client' %}
    
    {% set _query  = 'fuser' %}
    {% set param_userid = fuser_id_encoded %}
    {% if app_user_data()['type'] == constant('FREELANCER') %}
        {% set _action = 'freelancer' %}
        {% set _query  = 'buser' %}
        {% set param_userid = buser_id_encoded %}
    {% endif %}
    
    <section id=\"big_header\" class=\"contract-section\">
        <div class=\"container\">
            <div class=\"row \">
                <div style=\"border: 1px solid #ccc;border-radius: 4px 4px 0 0px;margin: 0;\" class=\"col-md-9 white-box black-box\">
                    <div class=\"row\">
                        <div class=\"date_head\">
                            <div class=\"col-md-6\">{{ app_lang('text_job_since')|format( app_date( job_status.start_date, ' M j, Y ') ) }}</div>
                            <div class=\"col-md-6\">
                                <div class=\"main_id\">
                                    <span>ID {{ job_status.contact_id }} </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-md-5\">
                            <div class=\"row\">
                                <div style=\"margin-left: 20px;\" class=\"col-md-4 col-md-offset-1 text-left\">
                                    <div class=\"st_img hourly_client_view_st_img\">
                                        <img src=\"{{ app_user_img( job_status.cropped_image ) }}\" width=\"64\" height=\"64\" />
                                    </div>
                                </div>
                                <div style=\"margin-left: -24px;\" class=\"col-md-7 text-left\">
                                    <div class=\"hourly_name\">
                                        <h5 style=\"margin-top: -4px;\" class=\"free_name\">{{ job_status.webuser_fname }} {{ job_status.webuser_lname }}</h5>
                                        <p class=\"free_name\">
                                            {% if app_user_data()['type'] == constant('FREELANCER') %}
                                                {{ app_substr(webuser.webuser_company, constant('CONTRACT_JOB_COMPANY_NAME_MAX'), '...') }}
                                            {% else %}
                                                {{ app_substr(job_status.tagline, constant('CONTRACT_JOB_TITLE_MAX'), '...') }}
                                            {% endif %}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=\"col-md-3 text-center gray-text\">
                            <div style=\"margin-top: -8px;\" class=\"status_bar\">
                                {% if webuser.isactive == 0 %}
                                    <label style=\"margin-top: -8px;\" class=\"gray-text\">
                                        {% set hold = \"<span style='color:#ff0000;'>%s</span>\" %}
                                        {{ app_lang('text_job_status_state')|format(hold)|format(app_lang('text_job_state_hold'))|raw }}
                                    </label>
                                {% elseif job_status.bid_status == 2  %}
                                    <label class=\"gray-text\">{{ app_lang('text_job_status_state')|format(app_lang('text_job_state_paused')) }}</label>
                                {% elseif job_status.jobstatus == 1 %}
                                    <label class=\"gray-text\">{{ app_lang('text_job_status_state')|format(app_lang('text_job_state_ended')) }}</label>
                                {% else %}
                                    <label class=\"gray-text\">{{ app_lang('text_job_status_state')|format(app_lang('text_job_state_actived')) }}</label>
                                {% endif %}
                            </div>
                        </div>
                        <div class=\"col-md-3 col-md-offset-1\">
                            <div class=\"msg_btnx hour_btn\">
                                <input type=\"button\" class=\"btn-primary transparent-btn big_mass_button _job_btn_message\" 
                                       value=\"{{ app_lang('text_job_btn_message') }}\" 
                                       data-bid=\"{{ job_status.bid_id }}\"
                                       data-uid=\"{{ chat_receiver_id }}\"
                                       data-jid=\"{{ job_status.job_id }}\" 
                                       />
                            </div>
                        </div>
                    </div>
                                       
                    <div class=\"col-md-12\">
                        <div class=\"job_title client_job_title\">
                            <span class=\"clint_view_j-title\">
                                {{ app_substr(job_title, constant('CONTRACT_JOB_TITLE_MAX'), '...') }}</span><br />
                            <a href=\"{{ base_url() }}jobs/view/{{ url_title( job_status.title ) }}/{{ job_id_encoded }}\">{{ app_lang('text_job_original_view') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class=\"bg-change\"></div>
            
            {% if job_status.job_type == constant('FIXED_JOB_TYPE') %}
                {{ include('webview/jobs/partials/job-nav-fixed-infos.twig') }}
            {% else %}
                {{ include('webview/jobs/partials/job-nav-hourly-infos.twig') }}
            {% endif %}
            
        </div>
    </section>
    
    {{ include('webview/modals/message-conversion-modal.twig', {'webuser_fname': job_status.webuser_fname, 'webuser_lname': job_status.webuser_lname , 'job_title': job_title }) }}
     
    {# Only include modal for client contract page #}
    {% if app_user_data()['type'] == constant('EMPLOYER') %}
        {{ include(\"webview/modals/milestone-modal.twig\") }}
        {{ include(\"webview/modals/payment-modal.twig\") }}
    {% endif %}
    
{% endblock %}

{% block js %}
    
    {# this variable defines the asset/modular/pages file to load #}
    <script> var page = 'contract'; </script>
    
    <script data-main=\"{{ app_modular_js(\"winjob\") }}\" src=\"{{ app_modular_js(\"lib/require.dev.js\") }}\"></script>
    <script src=\"{{ site_url(\"assets/js/vendor/modernizr-2.8.3.min.js\") }}\"></script>
    
{% endblock %}
", "webview/jobs/twig/contract.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\jobs\\twig\\contract.twig");
    }
}
