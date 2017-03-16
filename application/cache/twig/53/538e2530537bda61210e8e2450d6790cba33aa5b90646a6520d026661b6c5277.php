<?php

/* webview/jobs/twig/winsjob.twig */
class __TwigTemplate_423edc218afcc5677d7f024fa2968b871781c4a5c3d1ead64f4eedebd0f2ca5e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("webview/layout/twig/layout.twig", "webview/jobs/twig/winsjob.twig", 1);
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
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo "  ";
        echo twig_escape_filter($this->env, app_lang("text_job_title_winjob"), "html", null, true);
        echo " - Winjob  ";
    }

    // line 5
    public function block_styles($context, array $blocks = array())
    {
        // line 6
        echo "    ";
        $this->displayParentBlock("styles", $context, $blocks);
        echo "
    <link rel=\"stylesheet\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, base_url("assets/css/pages/job-common.css"), "html", null, true);
        echo "\">
    <link rel=\"stylesheet\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, base_url("assets/css/pages/mystaff.css"), "html", null, true);
        echo "\">
";
    }

    // line 11
    public function block_content($context, array $blocks = array())
    {
        // line 12
        echo "    <section id=\"big_header\" class=\"my_staff\">
\t<div class=\"container\">
\t    <div class=\"row \">
\t        <div class=\"col-md-3\">
                    <div class=\"row\">
                        <div class=\"col-md-10 nopadding\">
                            ";
        // line 18
        echo twig_include($this->env, $context, "webview/jobs/partials/job-freelancer-left-menu.twig", array("winjobs" => true), false);
        echo "
                        </div>
                    </div>
                </div>
                <div class=\"col-md-9\">
\t\t   <div class=\"row\">
                        
                        ";
        // line 26
        echo "                        ";
        $context["message"] = sprintf(app_lang("text_job_message_winjob"), (isset($context["count_"]) ? $context["count_"] : null));
        // line 27
        echo "                        ";
        $context["empty_message"] = app_lang("text_job_message_no_winjob");
        // line 28
        echo "                        ";
        echo twig_include($this->env, $context, "webview/jobs/partials/job-hirefeebar.twig", array("number" => (isset($context["count_"]) ? $context["count_"] : null), "message" => (isset($context["message"]) ? $context["message"] : null), "empty_message" => (isset($context["empty_message"]) ? $context["empty_message"] : null)), false);
        echo "
                       
                        ";
        // line 30
        $context["freelancer"] = true;
        // line 31
        echo "                        
                        ";
        // line 32
        if (array_key_exists("acccept_jobList", $context)) {
            // line 33
            echo "                            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["acccept_jobList"]) ? $context["acccept_jobList"] : null));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["job"]) {
                // line 34
                echo "                                
                                ";
                // line 36
                echo "                                ";
                $context["page"] = "winjobs";
                // line 37
                echo "                                
                                ";
                // line 39
                echo "                                ";
                $context["chat_receiver_id"] = $this->getAttribute($context["job"], "buser_id", array());
                // line 40
                echo "                                
                                ";
                // line 42
                echo "                                ";
                $context["job_id_encoded"] = base64_encode($this->getAttribute($context["job"], "job_id", array()));
                // line 43
                echo "                                ";
                $context["fuser_id_encoded"] = base64_encode($this->getAttribute($context["job"], "fuser_id", array()));
                // line 44
                echo "                                ";
                $context["bid_id_encoded"] = base64_encode($this->getAttribute($context["job"], "bid_id", array()));
                // line 45
                echo "                                ";
                $context["buser_id_encoded"] = base64_encode($this->getAttribute($context["job"], "buser_id", array()));
                // line 46
                echo "                                
                                ";
                // line 47
                $context["job_detail_link"] = ((base_url() . "jobs/contracts?fmJob=") . (isset($context["job_id_encoded"]) ? $context["job_id_encoded"] : null));
                // line 48
                echo "                                
                                ";
                // line 49
                if (($this->getAttribute($context["job"], "job_type", array()) == "hourly")) {
                    // line 50
                    echo "                                    ";
                    $context["end_contract_link"] = ((((base_url() . "endhourlyfixed/hourly_client?fmJob=") . (isset($context["job_id_encoded"]) ? $context["job_id_encoded"] : null)) . "&fuser=") . (isset($context["fuser_id_encoded"]) ? $context["fuser_id_encoded"] : null));
                    // line 51
                    echo "                                ";
                } else {
                    // line 52
                    echo "                                    ";
                    $context["end_contract_link"] = ((((base_url() . "endhourlyfixed/fixed_client?fmJob=") . (isset($context["job_id_encoded"]) ? $context["job_id_encoded"] : null)) . "&fuser=") . (isset($context["fuser_id_encoded"]) ? $context["fuser_id_encoded"] : null));
                    // line 53
                    echo "                                ";
                }
                // line 54
                echo "                                
                                ";
                // line 56
                echo "                                ";
                $context["specific_btn_template"] = "webview/jobs/partials/job-payment-buttons.twig";
                // line 57
                echo "                                ";
                $context["options_dropdown"] = "webview/jobs/partials/job-winsjob-dropdown.twig";
                // line 58
                echo "                                
                                ";
                // line 59
                $context["employerStatus"] = $this->getAttribute($context["job"], "isactive", array());
                // line 60
                echo "
                                ";
                // line 62
                echo "                                ";
                echo twig_include($this->env, $context, "webview/jobs/partials/job-item.twig");
                echo "
                             ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['job'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 64
            echo "                        ";
        }
        // line 65
        echo "                   </div>
                </div>
            </div>
        </div>
    </section>
                        
    ";
        // line 71
        echo twig_include($this->env, $context, "webview/modals/message-conversion-modal.twig");
        echo "
";
    }

    // line 74
    public function block_js($context, array $blocks = array())
    {
        // line 75
        echo "    
    ";
        // line 77
        echo "    <script> var page = 'my-staff'; </script>
    
    <script data-main=\"";
        // line 79
        echo twig_escape_filter($this->env, app_modular_js("winjob"), "html", null, true);
        echo "\" src=\"";
        echo twig_escape_filter($this->env, app_modular_js("lib/require.dev.js"), "html", null, true);
        echo "\"></script>
    
";
    }

    public function getTemplateName()
    {
        return "webview/jobs/twig/winsjob.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  225 => 79,  221 => 77,  218 => 75,  215 => 74,  209 => 71,  201 => 65,  198 => 64,  181 => 62,  178 => 60,  176 => 59,  173 => 58,  170 => 57,  167 => 56,  164 => 54,  161 => 53,  158 => 52,  155 => 51,  152 => 50,  150 => 49,  147 => 48,  145 => 47,  142 => 46,  139 => 45,  136 => 44,  133 => 43,  130 => 42,  127 => 40,  124 => 39,  121 => 37,  118 => 36,  115 => 34,  97 => 33,  95 => 32,  92 => 31,  90 => 30,  84 => 28,  81 => 27,  78 => 26,  68 => 18,  60 => 12,  57 => 11,  51 => 8,  47 => 7,  42 => 6,  39 => 5,  31 => 3,  11 => 1,);
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

{% block title %}  {{ app_lang('text_job_title_winjob') }} - Winjob  {% endblock %}

{% block styles %}
    {{ parent() }}
    <link rel=\"stylesheet\" href=\"{{ base_url(\"assets/css/pages/job-common.css\") }}\">
    <link rel=\"stylesheet\" href=\"{{ base_url(\"assets/css/pages/mystaff.css\") }}\">
{% endblock %}

{% block content %}
    <section id=\"big_header\" class=\"my_staff\">
\t<div class=\"container\">
\t    <div class=\"row \">
\t        <div class=\"col-md-3\">
                    <div class=\"row\">
                        <div class=\"col-md-10 nopadding\">
                            {{ include('webview/jobs/partials/job-freelancer-left-menu.twig', { winjobs: true }, with_context = false) }}
                        </div>
                    </div>
                </div>
                <div class=\"col-md-9\">
\t\t   <div class=\"row\">
                        
                        {# top message #}
                        {% set message       = app_lang('text_job_message_winjob')|format(count_) %}
                        {% set empty_message = app_lang('text_job_message_no_winjob') %}
                        {{ include('webview/jobs/partials/job-hirefeebar.twig', { number: count_, message: message , empty_message: empty_message }, with_context = false ) }}
                       
                        {% set freelancer = true %}
                        
                        {% if acccept_jobList is defined %}
                            {% for job in acccept_jobList %}
                                
                                {# specific the current page #}
                                {% set page = 'winjobs' %}
                                
                                {# chat receiver id #}
                                {% set chat_receiver_id      = job.buser_id %}
                                
                                {# specific job and page variable values #}
                                {% set job_id_encoded        = base64_encode(job.job_id) %}
                                {% set fuser_id_encoded      = base64_encode(job.fuser_id) %}
                                {% set bid_id_encoded        = base64_encode(job.bid_id) %}
                                {% set buser_id_encoded      = base64_encode(job.buser_id) %}
                                
                                {% set job_detail_link       = base_url() ~ \"jobs/contracts?fmJob=\" ~ job_id_encoded  %}
                                
                                {% if job.job_type == \"hourly\" %}
                                    {% set end_contract_link = base_url() ~ \"endhourlyfixed/hourly_client?fmJob=\" ~ job_id_encoded ~ '&fuser=' ~ fuser_id_encoded %}
                                {% else %}
                                    {% set end_contract_link = base_url() ~ \"endhourlyfixed/fixed_client?fmJob=\" ~ job_id_encoded ~ '&fuser=' ~ fuser_id_encoded %}
                                {% endif %}
                                
                                {# Specifics partials #}
                                {% set specific_btn_template = 'webview/jobs/partials/job-payment-buttons.twig' %}
                                {% set options_dropdown      = 'webview/jobs/partials/job-winsjob-dropdown.twig' %}
                                
                                {% set employerStatus =  job.isactive %}

                                {# To display profil link pass profil_link variable to job-item named as profil_link #}
                                {{ include('webview/jobs/partials/job-item.twig') }}
                             {% endfor %}
                        {% endif %}
                   </div>
                </div>
            </div>
        </div>
    </section>
                        
    {{ include('webview/modals/message-conversion-modal.twig') }}
{% endblock %}

{% block js %}
    
    {# this variable defines the asset/modular/pages file to load #}
    <script> var page = 'my-staff'; </script>
    
    <script data-main=\"{{ app_modular_js(\"winjob\") }}\" src=\"{{ app_modular_js(\"lib/require.dev.js\") }}\"></script>
    
{% endblock %}
", "webview/jobs/twig/winsjob.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\jobs\\twig\\winsjob.twig");
    }
}
