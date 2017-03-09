<?php

/* webview/jobs/twig/my-staff.twig */
class __TwigTemplate_b4c8e0ede79d33d461be2b3f14bcc9b28f4e9fda306695ab0ffb632b16352997 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("webview/layout/twig/layout.twig", "webview/jobs/twig/my-staff.twig", 1);
        $this->blocks = array(
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
    public function block_styles($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        $this->displayParentBlock("styles", $context, $blocks);
        echo "
    <link rel=\"stylesheet\" href=\"";
        // line 5
        echo twig_escape_filter($this->env, base_url("assets/css/pages/mystaff.css"), "html", null, true);
        echo "\">
";
    }

    // line 8
    public function block_content($context, array $blocks = array())
    {
        // line 9
        echo "    <section id=\"big_header\" class=\"my_staff\">
\t<div class=\"container\">
\t    <div class=\"row \">
\t        <div class=\"col-md-3\">
                    <div class=\"row\">
                        <div class=\"col-md-10 nopadding\">
                            <nav class=\"staff-navbar freelancer-navbar ms_navbar \">
                                <ul>
                                    <li><a class=\"active\" href=\"mystaff\"><i class=\"fa fa-briefcase\" aria-hidden=\"true\"></i> <b>";
        // line 17
        echo twig_escape_filter($this->env, app_lang("text_job_my_hired"), "html", null, true);
        echo "</b></a></li>
                                    <li><a href=\"pasthire\"><i class=\"fa fa-undo\" aria-hidden=\"true\"></i> <b>";
        // line 18
        echo twig_escape_filter($this->env, app_lang("text_job_past_hired"), "html", null, true);
        echo "</b></a></li>
                                    <li><a href=\"offersent\"><i class=\"fa fa-gift\" aria-hidden=\"true\"></i> <b>";
        // line 19
        echo twig_escape_filter($this->env, app_lang("text_job_offer_sent"), "html", null, true);
        echo "</b></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class=\"col-md-9\">
\t\t   <div class=\"row\">
                       <div class=\"col-md-12 bordered-alert text-center hirefeebar\">
                           ";
        // line 28
        if (((isset($context["nb_freelancer_hired"]) ? $context["nb_freelancer_hired"] : null) > 0)) {
            // line 29
            echo "                               <h4>";
            echo twig_escape_filter($this->env, sprintf(app_lang("text_job_mystaff_hired"), (isset($context["nb_freelancer_hired"]) ? $context["nb_freelancer_hired"] : null)), "html", null, true);
            echo "</h4>    
                           ";
        } else {
            // line 31
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
        // line 38
        echo "                       </div>
                        ";
        // line 39
        if (array_key_exists("jobs_accepted", $context)) {
            // line 40
            echo "                            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["jobs_accepted"]) ? $context["jobs_accepted"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["job"]) {
                // line 41
                echo "                                 ";
                echo twig_include($this->env, $context, "webview/jobs/partials/job-item.twig", array("job" => $context["job"], "freelancer_job_hour" => (isset($context["freelancer_job_hour"]) ? $context["freelancer_job_hour"] : null)), false);
                echo "
                             ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['job'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 43
            echo "                        ";
        }
        // line 44
        echo "                   </div>
                </div>
            </div>
        </div>
    </section>
                        
    ";
        // line 50
        echo twig_include($this->env, $context, "webview/modals/message-conversion-modal.twig");
        echo "
";
    }

    // line 53
    public function block_js($context, array $blocks = array())
    {
        // line 54
        echo "    ";
        $this->displayParentBlock("js", $context, $blocks);
        echo "
    ";
        // line 56
        echo "    <script src=\"";
        echo twig_escape_filter($this->env, app_modular_js("pages/my-staff.js"), "html", null, true);
        echo "\"></script>
";
    }

    public function getTemplateName()
    {
        return "webview/jobs/twig/my-staff.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  140 => 56,  135 => 54,  132 => 53,  126 => 50,  118 => 44,  115 => 43,  106 => 41,  101 => 40,  99 => 39,  96 => 38,  85 => 31,  79 => 29,  77 => 28,  65 => 19,  61 => 18,  57 => 17,  47 => 9,  44 => 8,  38 => 5,  33 => 4,  30 => 3,  11 => 1,);
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
                            <nav class=\"staff-navbar freelancer-navbar ms_navbar \">
                                <ul>
                                    <li><a class=\"active\" href=\"mystaff\"><i class=\"fa fa-briefcase\" aria-hidden=\"true\"></i> <b>{{ app_lang('text_job_my_hired')  }}</b></a></li>
                                    <li><a href=\"pasthire\"><i class=\"fa fa-undo\" aria-hidden=\"true\"></i> <b>{{ app_lang('text_job_past_hired')  }}</b></a></li>
                                    <li><a href=\"offersent\"><i class=\"fa fa-gift\" aria-hidden=\"true\"></i> <b>{{ app_lang('text_job_offer_sent')  }}</b></a></li>
                                </ul>
                            </nav>
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
                                 {{ include('webview/jobs/partials/job-item.twig', {'job': job, 'freelancer_job_hour': freelancer_job_hour }, with_context = false) }}
                             {% endfor %}
                        {% endif %}
                   </div>
                </div>
            </div>
        </div>
    </section>
                        
    {{ include('webview/modals/message-conversion-modal.twig')}}
{% endblock %}

{% block js %}
    {{ parent() }}
    {# <!-- <script data-main=\"{{ app_modular_js(\"mystaff\") }}\" src=\"{{ app_modular_js(\"lib/require.dev.js\") }}\"></script> --> #}
    <script src=\"{{ app_modular_js(\"pages/my-staff.js\") }}\"></script>
{% endblock %}
", "webview/jobs/twig/my-staff.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\jobs\\twig\\my-staff.twig");
    }
}
