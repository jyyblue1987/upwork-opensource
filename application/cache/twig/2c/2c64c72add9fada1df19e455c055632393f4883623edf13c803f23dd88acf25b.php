<?php

/* webview/jobs/partials/job-client-contracts-menu.twig */
class __TwigTemplate_d3e9baab3e97924009f8e566177c62f49457137ff30d13ef998f1c2b0bbea248 extends Twig_Template
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
        if ((isset($context["active"]) ? $context["active"] : null)) {
            echo " active ";
        }
        echo "\" href=\"";
        echo twig_escape_filter($this->env, site_url("jobs/my-contracts"), "html", null, true);
        echo "\"><i class=\"fa fa-briefcase\" aria-hidden=\"true\"></i> <b>";
        echo twig_escape_filter($this->env, app_lang("text_job_menu_active_contracts"), "html", null, true);
        echo "</b></a></li>
        <li><a class=\"";
        // line 4
        if ((isset($context["ended"]) ? $context["ended"] : null)) {
            echo " active ";
        }
        echo "\" href=\"";
        echo twig_escape_filter($this->env, site_url("jobs/ended-contracts"), "html", null, true);
        echo "\"><i class=\"fa fa-undo\" aria-hidden=\"true\"></i> <b>";
        echo twig_escape_filter($this->env, app_lang("text_job_menu_ended_contracts"), "html", null, true);
        echo "</b></a></li>
    </ul>
</nav>";
    }

    public function getTemplateName()
    {
        return "webview/jobs/partials/job-client-contracts-menu.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  33 => 4,  23 => 3,  19 => 1,);
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
        <li><a class=\"{% if active %} active {% endif %}\" href=\"{{ site_url('jobs/my-contracts') }}\"><i class=\"fa fa-briefcase\" aria-hidden=\"true\"></i> <b>{{ app_lang('text_job_menu_active_contracts')  }}</b></a></li>
        <li><a class=\"{% if ended %} active {% endif %}\" href=\"{{ site_url('jobs/ended-contracts') }}\"><i class=\"fa fa-undo\" aria-hidden=\"true\"></i> <b>{{ app_lang('text_job_menu_ended_contracts')  }}</b></a></li>
    </ul>
</nav>", "webview/jobs/partials/job-client-contracts-menu.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\jobs\\partials\\job-client-contracts-menu.twig");
    }
}
