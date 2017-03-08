<?php

/* webview/jobs/my-staff.twig */
class __TwigTemplate_1b9b41ebfa8d4e76f6929e7df0813721bddd4fec14d836fdc0953fd724c70e49 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("webview/layout/twig/layout.twig", "webview/jobs/my-staff.twig", 1);
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
        echo "    <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, site_url("assets/css/mystaff.css"), "html", null, true);
        echo "\">
";
    }

    // line 7
    public function block_content($context, array $blocks = array())
    {
        // line 8
        echo "    <section id=\"big_header\" class=\"my_staff\">
\t<div class=\"container\">
\t    <div class=\"row \">
\t        <div class=\"col-md-3\">
                    <div class=\"row\">
                        <div class=\"col-md-10 nopadding\">
                            <nav class=\"staff-navbar freelancer-navbar ms_navbar \">
                                <ul>
                                    <li><a class=\"active\" href=\"mystaff\"><i class=\"fa fa-briefcase\" aria-hidden=\"true\"></i> <b>My Hired</b></a></li>
                                    <li><a href=\"pasthire\"><i class=\"fa fa-undo\" aria-hidden=\"true\"></i> <b>Past Hires</b></a></li>
                                    <li><a href=\"offersent\"><i class=\"fa fa-gift\" aria-hidden=\"true\"></i> <b>Offers Sent</b></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class=\"col-md-9\">
\t\t   <div class=\"row\">
                       <div class=\"col-md-12 bordered-alert text-center hirefeebar\">
                           ";
        // line 27
        if (((isset($context["nb_freelancer_hired"]) ? $context["nb_freelancer_hired"] : null) > 0)) {
            // line 28
            echo "                               <h4>";
            echo twig_escape_filter($this->env, sprintf(app_lang("text_job_mystaff_hired"), (isset($context["nb_freelancer_hired"]) ? $context["nb_freelancer_hired"] : null)), "html", null, true);
            echo "</h4>    
                           ";
        } else {
            // line 30
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
        // line 37
        echo "                       </div>
                   </div>
                   ";
        // line 39
        if (array_key_exists("jobs_accepted", $context)) {
            // line 40
            echo "                       ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["jobs_accepted"]) ? $context["jobs_accepted"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["job"]) {
                // line 41
                echo "                            ";
                echo twig_include($this->env, $context, "webview/jobs/partials/job-item.twig", array("job" => $context["job"], "freelancer_job_hour" => (isset($context["freelancer_job_hour"]) ? $context["freelancer_job_hour"] : null)), false);
                echo "
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['job'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 43
            echo "                   ";
        }
        // line 44
        echo "                </div>
            </div>
        </div>
    </section>
";
    }

    // line 50
    public function block_js($context, array $blocks = array())
    {
        // line 51
        echo "    <script data-main=\"";
        echo twig_escape_filter($this->env, app_modular_js("mystaff"), "html", null, true);
        echo "\" src=\"";
        echo twig_escape_filter($this->env, app_modular_js("lib/require.dev.js"), "html", null, true);
        echo "\"></script>
";
    }

    public function getTemplateName()
    {
        return "webview/jobs/my-staff.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  117 => 51,  114 => 50,  106 => 44,  103 => 43,  94 => 41,  89 => 40,  87 => 39,  83 => 37,  72 => 30,  66 => 28,  64 => 27,  43 => 8,  40 => 7,  33 => 4,  30 => 3,  11 => 1,);
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
    <link rel=\"stylesheet\" href=\"{{ site_url(\"assets/css/mystaff.css\") }}\">
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
                                    <li><a class=\"active\" href=\"mystaff\"><i class=\"fa fa-briefcase\" aria-hidden=\"true\"></i> <b>My Hired</b></a></li>
                                    <li><a href=\"pasthire\"><i class=\"fa fa-undo\" aria-hidden=\"true\"></i> <b>Past Hires</b></a></li>
                                    <li><a href=\"offersent\"><i class=\"fa fa-gift\" aria-hidden=\"true\"></i> <b>Offers Sent</b></a></li>
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
                   </div>
                   {% if jobs_accepted is defined %}
                       {% for job in jobs_accepted %}
                            {{ include('webview/jobs/partials/job-item.twig', {'job': job, 'freelancer_job_hour': freelancer_job_hour }, with_context = false) }}
                        {% endfor %}
                   {% endif %}
                </div>
            </div>
        </div>
    </section>
{% endblock %}

{% block js %}
    <script data-main=\"{{ app_modular_js(\"mystaff\") }}\" src=\"{{ app_modular_js(\"lib/require.dev.js\") }}\"></script>
{% endblock %}
", "webview/jobs/my-staff.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\jobs\\my-staff.twig");
    }
}
