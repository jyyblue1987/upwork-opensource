<?php

/* webview/jobs/partials/job-freelancer-left-menu.twig */
class __TwigTemplate_516350c97656f2509f118c19650652cfa31c27ec10aca40d007c91599371e967 extends Twig_Template
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
        echo "<nav class=\"staff-navbar freelancer-navbar ms_navbar \">
    <ul>
        <li><a class=\"";
        // line 3
        if ((isset($context["winjobs"]) ? $context["winjobs"] : null)) {
            echo " active ";
        }
        echo "\" href=\"win-jobs\"><i class=\"fa fa-briefcase\" aria-hidden=\"true\"></i> <b>";
        echo twig_escape_filter($this->env, app_lang("text_job_menu_win_jobs"), "html", null, true);
        echo "</b></a></li>
        <li><a class=\"";
        // line 4
        if ((isset($context["endedjobs"]) ? $context["endedjobs"] : null)) {
            echo " active ";
        }
        echo "\" href=\"ended-jobs\"><i class=\"fa fa-undo\" aria-hidden=\"true\"></i> <b>";
        echo twig_escape_filter($this->env, app_lang("text_job_menu_ended_jobs"), "html", null, true);
        echo "</b></a></li> 
    </ul>
</nav>";
    }

    public function getTemplateName()
    {
        return "webview/jobs/partials/job-freelancer-left-menu.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  31 => 4,  23 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<nav class=\"staff-navbar freelancer-navbar ms_navbar \">
    <ul>
        <li><a class=\"{% if winjobs %} active {% endif %}\" href=\"win-jobs\"><i class=\"fa fa-briefcase\" aria-hidden=\"true\"></i> <b>{{ app_lang('text_job_menu_win_jobs')  }}</b></a></li>
        <li><a class=\"{% if endedjobs %} active {% endif %}\" href=\"ended-jobs\"><i class=\"fa fa-undo\" aria-hidden=\"true\"></i> <b>{{ app_lang('text_job_menu_ended_jobs')  }}</b></a></li> 
    </ul>
</nav>", "webview/jobs/partials/job-freelancer-left-menu.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\jobs\\partials\\job-freelancer-left-menu.twig");
    }
}
