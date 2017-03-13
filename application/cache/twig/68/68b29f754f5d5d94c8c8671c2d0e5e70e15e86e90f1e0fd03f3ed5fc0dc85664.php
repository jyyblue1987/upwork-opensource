<?php

/* webview/jobs/partials/job-offer-buttons.twig */
class __TwigTemplate_c196746194d9d3703d713f76c592e3f4efde33115b5c97aa4ac34f71f68a02ed extends Twig_Template
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
        if ((isset($context["cancel_link"]) ? $context["cancel_link"] : null)) {
            // line 2
            echo "<div class=\"os_cancel_butt\">
    <div class=\"cancel_btn\">
        <a href=\"";
            // line 4
            echo twig_escape_filter($this->env, (isset($context["cancel_link"]) ? $context["cancel_link"] : null), "html", null, true);
            echo "\" class=\"btn btn-primary form-btn\">";
            echo twig_escape_filter($this->env, app_lang("text_job_btn_cancel_offer"), "html", null, true);
            echo "</a>
    </div> 
</div>
";
        }
    }

    public function getTemplateName()
    {
        return "webview/jobs/partials/job-offer-buttons.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  25 => 4,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% if cancel_link %}
<div class=\"os_cancel_butt\">
    <div class=\"cancel_btn\">
        <a href=\"{{ cancel_link }}\" class=\"btn btn-primary form-btn\">{{ app_lang('text_job_btn_cancel_offer') }}</a>
    </div> 
</div>
{% endif  %}", "webview/jobs/partials/job-offer-buttons.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\jobs\\partials\\job-offer-buttons.twig");
    }
}
