<?php

/* webview/jobs/partials/job-user-info.twig */
class __TwigTemplate_cfe0702bad556a99bdd2a01b3eb557095ac60841584506d0009abbc776504e3c extends Twig_Template
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
        echo "<div class=\"col-md-4\">
    <div class=\"row\">
        <div class=\"col-md-5\" style=\"padding-left:-20px\">
            <div class=\"st_img freelancer_img\">
                <img src=\"";
        // line 5
        echo twig_escape_filter($this->env, app_user_img($this->getAttribute((isset($context["job"]) ? $context["job"] : null), "webuser_picture", array())), "html", null, true);
        echo "\" width=\"85\" height=\"68\">
            </div>
        </div>
        <div class=\"col-md-7 nopadding\" style=\"padding-left: -15px !important\">
            <div class=\"user_name\" style=\"padding-left:2px\">
                <h5 style=\"margin-bottom:0\">
                    ";
        // line 11
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "webuser_fname", array()), "html", null, true);
        echo "  ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "webuser_lname", array()), "html", null, true);
        echo "
                    <br/>
                </h5>
                <span>";
        // line 14
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "country_name", array()), "html", null, true);
        echo "</span>
            </div>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "webview/jobs/partials/job-user-info.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  42 => 14,  34 => 11,  25 => 5,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"col-md-4\">
    <div class=\"row\">
        <div class=\"col-md-5\" style=\"padding-left:-20px\">
            <div class=\"st_img freelancer_img\">
                <img src=\"{{ app_user_img(job.webuser_picture) }}\" width=\"85\" height=\"68\">
            </div>
        </div>
        <div class=\"col-md-7 nopadding\" style=\"padding-left: -15px !important\">
            <div class=\"user_name\" style=\"padding-left:2px\">
                <h5 style=\"margin-bottom:0\">
                    {{ job.webuser_fname }}  {{ job.webuser_lname }}
                    <br/>
                </h5>
                <span>{{ job.country_name }}</span>
            </div>
        </div>
    </div>
</div>", "webview/jobs/partials/job-user-info.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\jobs\\partials\\job-user-info.twig");
    }
}
