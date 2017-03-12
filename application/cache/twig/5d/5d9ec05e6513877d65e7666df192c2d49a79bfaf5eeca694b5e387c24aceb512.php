<?php

/* webview/jobs/partials/job-hirefeebar.twig */
class __TwigTemplate_ae6e33793b374f138cc3f8ceba6a28eb5dddf96040ec33ee992131b5903a6e31 extends Twig_Template
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
        echo "<div class=\"col-md-12 bordered-alert text-center hirefeebar\">
    ";
        // line 2
        if (((isset($context["number"]) ? $context["number"] : null) > 0)) {
            // line 3
            echo "        <h4>";
            echo twig_escape_filter($this->env, (isset($context["message"]) ? $context["message"] : null), "html", null, true);
            echo "</h4>    
    ";
        } else {
            // line 5
            echo "        <h4>";
            echo twig_escape_filter($this->env, (isset($context["empty_message"]) ? $context["empty_message"] : null), "html", null, true);
            echo "</h4>
        <div class=\"row\">
             <div class=\"col-md-12\">
                 <div class=\"border-box empty_freelancer_box\"></div>
             </div>
         </div>
    ";
        }
        // line 12
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "webview/jobs/partials/job-hirefeebar.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  41 => 12,  30 => 5,  24 => 3,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"col-md-12 bordered-alert text-center hirefeebar\">
    {% if number > 0 %}
        <h4>{{ message }}</h4>    
    {% else %}
        <h4>{{ empty_message  }}</h4>
        <div class=\"row\">
             <div class=\"col-md-12\">
                 <div class=\"border-box empty_freelancer_box\"></div>
             </div>
         </div>
    {% endif %}
</div>", "webview/jobs/partials/job-hirefeebar.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\jobs\\partials\\job-hirefeebar.twig");
    }
}
