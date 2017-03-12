<?php

/* webview/jobs/partials/job-hire-dropdown.twig */
class __TwigTemplate_c028caf68c03df585413a43fa0112639462d2981bced01c586076e3da336250f extends Twig_Template
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
        echo "<li><a href=\"#\">";
        echo twig_escape_filter($this->env, app_lang("text_job_btn_op_view_ended_contract"), "html", null, true);
        echo "</a></li>";
    }

    public function getTemplateName()
    {
        return "webview/jobs/partials/job-hire-dropdown.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<li><a href=\"#\">{{ app_lang('text_job_btn_op_view_ended_contract') }}</a></li>", "webview/jobs/partials/job-hire-dropdown.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\jobs\\partials\\job-hire-dropdown.twig");
    }
}
