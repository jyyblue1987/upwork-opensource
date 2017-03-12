<?php

/* webview/jobs/partials/job-hire-button.twig */
class __TwigTemplate_02f91a26f97e8f6a6e8b5fcd781aafa6cc37251200f9d38c13d9841707673f82 extends Twig_Template
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
        // line 2
        echo "<div class=\"ph_rehire_butt\">
    <div class=\"rehire-btn\">
        <input type=\"button\" class=\"btn btn-primary form-btn\" value=\"";
        // line 4
        echo twig_escape_filter($this->env, app_lang("text_job_btn_refired"), "html", null, true);
        echo "\" />
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "webview/jobs/partials/job-hire-button.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  23 => 4,  19 => 2,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{# empty Twig template #}
<div class=\"ph_rehire_butt\">
    <div class=\"rehire-btn\">
        <input type=\"button\" class=\"btn btn-primary form-btn\" value=\"{{ app_lang('text_job_btn_refired') }}\" />
    </div>
</div>", "webview/jobs/partials/job-hire-button.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\jobs\\partials\\job-hire-button.twig");
    }
}
