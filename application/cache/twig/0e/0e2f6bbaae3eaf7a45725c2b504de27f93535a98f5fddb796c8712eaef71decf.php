<?php

/* webview/jobs/partials/job-client-left-menu.twig */
class __TwigTemplate_00a9f42d64a8a0ddd58b0027538fdfeb60f463e399496c6e8f59a35046df986d extends Twig_Template
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
        if ((isset($context["mystaff"]) ? $context["mystaff"] : null)) {
            echo " active ";
        }
        echo "\" href=\"mystaff\"><i class=\"fa fa-briefcase\" aria-hidden=\"true\"></i> <b>";
        echo twig_escape_filter($this->env, app_lang("text_job_my_hired"), "html", null, true);
        echo "</b></a></li>
        <li><a class=\"";
        // line 4
        if ((isset($context["pasthired"]) ? $context["pasthired"] : null)) {
            echo " active ";
        }
        echo "\" href=\"pasthire\"><i class=\"fa fa-undo\" aria-hidden=\"true\"></i> <b>";
        echo twig_escape_filter($this->env, app_lang("text_job_past_hired"), "html", null, true);
        echo "</b></a></li>
        <li><a class=\"";
        // line 5
        if ((isset($context["offersent"]) ? $context["offersent"] : null)) {
            echo " active ";
        }
        echo "\" href=\"offersent\"><i class=\"fa fa-gift\" aria-hidden=\"true\"></i> <b>";
        echo twig_escape_filter($this->env, app_lang("text_job_offer_sent"), "html", null, true);
        echo "</b></a></li>
    </ul>
</nav>";
    }

    public function getTemplateName()
    {
        return "webview/jobs/partials/job-client-left-menu.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 5,  31 => 4,  23 => 3,  19 => 1,);
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
        <li><a class=\"{% if mystaff %} active {% endif %}\" href=\"mystaff\"><i class=\"fa fa-briefcase\" aria-hidden=\"true\"></i> <b>{{ app_lang('text_job_my_hired')  }}</b></a></li>
        <li><a class=\"{% if pasthired %} active {% endif %}\" href=\"pasthire\"><i class=\"fa fa-undo\" aria-hidden=\"true\"></i> <b>{{ app_lang('text_job_past_hired')  }}</b></a></li>
        <li><a class=\"{% if offersent %} active {% endif %}\" href=\"offersent\"><i class=\"fa fa-gift\" aria-hidden=\"true\"></i> <b>{{ app_lang('text_job_offer_sent')  }}</b></a></li>
    </ul>
</nav>", "webview/jobs/partials/job-client-left-menu.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\jobs\\partials\\job-client-left-menu.twig");
    }
}
