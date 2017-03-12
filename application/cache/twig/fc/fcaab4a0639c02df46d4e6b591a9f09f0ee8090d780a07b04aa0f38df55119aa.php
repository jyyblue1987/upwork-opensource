<?php

/* webview/jobs/twig/pasthired.twig */
class __TwigTemplate_ce62bdf3977696c468cc1cfcedf3f90c216f650d2ec81fc0371e44c812a84f45 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("webview/layout/twig/layout.twig", "webview/jobs/twig/pasthired.twig", 1);
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
        echo twig_escape_filter($this->env, app_lang("text_job_pasthired"), "html", null, true);
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
        echo twig_escape_filter($this->env, base_url("assets/css/pages/mystaff.css"), "html", null, true);
        echo "\">
";
    }

    // line 10
    public function block_content($context, array $blocks = array())
    {
        // line 11
        echo "    <section id=\"big_header\" class=\"my_staff\">
\t<div class=\"container\">
\t    <div class=\"row \">
\t        <div class=\"col-md-3\">
                    <div class=\"row\">
                        <div class=\"col-md-10 nopadding\">
                            ";
        // line 17
        echo twig_include($this->env, $context, "webview/jobs/partials/job-client-left-menu.twig", array("pasthired" => true), false);
        echo "
                        </div>
                    </div>
                </div>
                <div class=\"col-md-9\">
\t\t   <div class=\"row\">
                       <div class=\"col-md-12 bordered-alert text-center hirefeebar\">
                           ";
        // line 24
        if (((isset($context["nb_freelancer_hired"]) ? $context["nb_freelancer_hired"] : null) > 0)) {
            // line 25
            echo "                               <h4>";
            echo twig_escape_filter($this->env, sprintf(app_lang("text_job_mystaff_hired"), (isset($context["nb_freelancer_hired"]) ? $context["nb_freelancer_hired"] : null)), "html", null, true);
            echo "</h4>    
                           ";
        } else {
            // line 27
            echo "                               <h4>";
            echo twig_escape_filter($this->env, app_lang("text_job_mystaff_not_hired"), "html", null, true);
            echo "</h4>
                               <div class=\"row\">
                                    <div class=\"col-md-12\">
                                        <div class=\"border-box empty_freelancer_box\"></div>
                                    </div>
                                </div>
                           ";
        }
        // line 34
        echo "                       </div>
                        ";
        // line 35
        if (array_key_exists("jobs_accepted", $context)) {
            // line 36
            echo "                            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["jobs_accepted"]) ? $context["jobs_accepted"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["job"]) {
                // line 37
                echo "                                 ";
                $context["profil_link"] = ((((((base_url() . "interview?user_id=") . base64_encode($this->getAttribute($context["job"], "fuser_id", array()))) . "&job_id=") . base64_encode($this->getAttribute($context["job"], "job_id", array()))) . "&bid_id=") . base64_encode($this->getAttribute($context["job"], "bid_id", array())));
                // line 38
                echo "                                 ";
                // line 39
                echo "                                 ";
                echo twig_include($this->env, $context, "webview/jobs/partials/job-item.twig", array("job" => $context["job"], "freelancer_job_hour" => (isset($context["freelancer_job_hour"]) ? $context["freelancer_job_hour"] : null), "profil_link" => (isset($context["profil_link"]) ? $context["profil_link"] : null)), false);
                echo "
                             ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['job'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 41
            echo "                        ";
        }
        // line 42
        echo "                   </div>
                </div>
            </div>
        </div>
    </section>
                        
    ";
        // line 48
        echo twig_include($this->env, $context, "webview/modals/message-conversion-modal.twig");
        echo "
";
    }

    // line 51
    public function block_js($context, array $blocks = array())
    {
        // line 52
        echo "    ";
        $this->displayParentBlock("js", $context, $blocks);
        echo "
    ";
        // line 54
        echo "    <script src=\"";
        echo twig_escape_filter($this->env, app_modular_js("pages/my-staff.js"), "html", null, true);
        echo "\"></script>
";
    }

    public function getTemplateName()
    {
        return "webview/jobs/twig/pasthired.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  142 => 54,  137 => 52,  134 => 51,  128 => 48,  120 => 42,  117 => 41,  108 => 39,  106 => 38,  103 => 37,  98 => 36,  96 => 35,  93 => 34,  82 => 27,  76 => 25,  74 => 24,  64 => 17,  56 => 11,  53 => 10,  47 => 7,  42 => 6,  39 => 5,  31 => 3,  11 => 1,);
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

{% block title %}  {{ app_lang('text_job_pasthired') }} - Winjob  {% endblock %}

{% block styles %}
    {{ parent() }}
    <link rel=\"stylesheet\" href=\"{{ base_url(\"assets/css/pages/mystaff.css\") }}\">
{% endblock %}

{% block content %}
    <section id=\"big_header\" class=\"my_staff\">
\t<div class=\"container\">
\t    <div class=\"row \">
\t        <div class=\"col-md-3\">
                    <div class=\"row\">
                        <div class=\"col-md-10 nopadding\">
                            {{ include('webview/jobs/partials/job-client-left-menu.twig', { pasthired: true }, with_context = false) }}
                        </div>
                    </div>
                </div>
                <div class=\"col-md-9\">
\t\t   <div class=\"row\">
                       <div class=\"col-md-12 bordered-alert text-center hirefeebar\">
                           {% if nb_freelancer_hired > 0 %}
                               <h4>{{ app_lang('text_job_mystaff_hired')|format(nb_freelancer_hired)  }}</h4>    
                           {% else %}
                               <h4>{{ app_lang('text_job_mystaff_not_hired')  }}</h4>
                               <div class=\"row\">
                                    <div class=\"col-md-12\">
                                        <div class=\"border-box empty_freelancer_box\"></div>
                                    </div>
                                </div>
                           {% endif %}
                       </div>
                        {% if jobs_accepted is defined %}
                            {% for job in jobs_accepted %}
                                 {% set profil_link = base_url() ~ \"interview?user_id=\" ~ base64_encode(job.fuser_id) ~ \"&job_id=\" ~ base64_encode(job.job_id) ~ \"&bid_id=\" ~ base64_encode(job.bid_id) %}
                                 {# To display profil link pass profil_link variable to job-item named as profil_link #}
                                 {{ include('webview/jobs/partials/job-item.twig', {'job': job, 'freelancer_job_hour': freelancer_job_hour, 'profil_link': profil_link }, with_context = false) }}
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
    {{ parent() }}
    {# <!-- <script data-main=\"{{ app_modular_js(\"mystaff\") }}\" src=\"{{ app_modular_js(\"lib/require.dev.js\") }}\"></script> --> #}
    <script src=\"{{ app_modular_js(\"pages/my-staff.js\") }}\"></script>
{% endblock %}
", "webview/jobs/twig/pasthired.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\jobs\\twig\\pasthired.twig");
    }
}
